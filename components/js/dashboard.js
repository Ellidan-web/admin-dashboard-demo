const endpoint = "./js/sampledata.json";
let dataRaw = [];

// Event listeners
document.getElementById('applyFilter').onclick = renderDashboard;
document.getElementById('resetFilter').onclick = () => {
  document.getElementById('startDate').value = '';
  document.getElementById('endDate').value = '';
  document.getElementById('officeSelect').value = '';
  renderDashboard();
};

// Load data
async function loadData() {
  const resp = await fetch(endpoint);
  dataRaw = await resp.json();
  renderDashboard();
}

// Filter by date and office
function filterByDate(data) {
  const start = document.getElementById('startDate').value;
  const end = document.getElementById('endDate').value;
  const office = document.getElementById('officeSelect').value;

  const startDate = start ? new Date(start) : null;
  const endDate = end ? new Date(end) : null;
  const selectedOffice = office.trim().toLowerCase();

  return data.filter(r => {
    const recordDate = new Date(r['DATE:']);
    if (!isValidDate(recordDate)) return false;

    const recordOffice = (r['OFFICE:'] || '').trim().toLowerCase();
    const dateMatch = (!startDate || recordDate >= startDate) &&
                      (!endDate || recordDate <= endDate);
    const officeMatch = selectedOffice === '' || recordOffice === selectedOffice;

    return dateMatch && officeMatch;
  });
}

// Group data by key
function groupBy(arr, key, topN = null) {
  const count = {};
  arr.forEach(r => {
    const v = r[key] || 'Unknown';
    count[v] = (count[v] || 0) + 1;
  });

  let entries = Object.entries(count).map(([k, v]) => ({ k, v }));
  if (topN) entries = entries.sort((a, b) => b.v - a.v).slice(0, topN);
  return entries;
}

// Group by range
function groupByRange(arr, key, ranges) {
  const result = {};
  arr.forEach(r => {
    const age = parseInt(r[key]);
    if (!isNaN(age) && age >= 0) {
      for (let i = 0; i < ranges.length - 1; i++) {
        const label = `${ranges[i]}–${ranges[i + 1] - 1}`;
        if (age >= ranges[i] && age < ranges[i + 1]) {
          result[label] = (result[label] || 0) + 1;
          return;
        }
      }
      const lastLabel = `${ranges[ranges.length - 1]}+`;
      result[lastLabel] = (result[lastLabel] || 0) + 1;
    }
  });
  return Object.entries(result).map(([k, v]) => ({ k, v }));
}

// Render dashboard
function renderDashboard() {
  const data = filterByDate(dataRaw);
  const charts = [];

  // Chart configurations (same as original)
  charts.push({ id: 'chartClientType', type: 'pie', data: groupBy(data, 'CLIENT TYPE:'), title: 'Client Type' });
  charts.push({ id: 'chartSex', type: 'pie', data: groupBy(data, 'SEX:'), title: 'Sex' });
  charts.push({ id: 'chartAge', type: 'bar', data: groupByRange(data, 'AGE:', [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150]), title: 'Age Distribution by Group (0–150+)' });
  charts.push({ id: 'chartBarangay', type: 'bar', data: groupBy(data, 'BARANGAY IN NAGA CITY:', 24), title: 'Top Barangays' });
  charts.push({ id: 'chartCC1', type: 'pie', data: groupBy(data, 'CC1:'), title: 'CC1 Awareness' });
  charts.push({ id: 'chartCC2', type: 'bar', data: groupBy(data, 'CC2:'), title: 'CC2 Visibility' });
  charts.push({ id: 'chartCC3', type: 'bar', data: groupBy(data, 'CC3:'), title: 'CC3 Helpfulness' });
  charts.push({ id: 'chartOffice', type: 'bar', data: groupBy(data, 'OFFICE:', 56), title: 'OFFICE (as entered)' });

  // SQD Chart (same as original)
  const sqdKeys = ['SQD0', 'SQD1', 'SQD2', 'SQD3', 'SQD4', 'SQD5', 'SQD6', 'SQD7', 'SQD8'];
  const sqdLevels = ['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree', 'Not Applicable'];
  const sqdCounts = {};
  
  sqdKeys.forEach(k => {
    sqdCounts[k] = {};
    sqdLevels.forEach(l => sqdCounts[k][l] = 0);
  });

  data.forEach(r => {
    sqdKeys.forEach(k => {
      let v = r[k];
      if (sqdCounts[k][v] !== undefined) sqdCounts[k][v]++;
    });
  });

  charts.push({ 
    id: 'chartSQD', 
    type: 'barStacked', 
    data: { keys: sqdKeys, counts: sqdCounts, levels: sqdLevels }, 
    title: 'SQD0–SQD8 Ratings' 
  });

  // Render charts (same chart rendering logic as original)
  charts.forEach(cfg => {
    if (Chart.getChart(cfg.id)) Chart.getChart(cfg.id).destroy();
    const ctx = document.getElementById(cfg.id).getContext('2d');

    if (cfg.type === 'barStacked') {
      // Stacked bar chart rendering (same as original)
      const labels = cfg.data.keys;
      const datasets = cfg.data.levels.map((lvl, i) => ({
        label: lvl,
        data: labels.map(k => cfg.data.counts[k][lvl]),
        backgroundColor: ['#8B0000', '#E97451', '#D3D3D3', '#FFD700', '#32CD32', '#C0B7D2'][i]
      }));

      new Chart(ctx, {
        type: 'bar',
        data: { labels, datasets },
        options: {
          plugins: {
            title: { display: true, text: cfg.title, font: { size: 16, weight: 'bold' }, padding: { top: 10, bottom: 20 } },
            legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyle: 'circle' } },
            tooltip: { mode: 'index', intersect: false }
          },
          responsive: true,
          maintainAspectRatio: false,
          animation: { duration: 1000, easing: 'easeOutQuart' },
          scales: {
            x: { stacked: true, grid: { display: false } },
            y: { stacked: true, beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }
          }
        }
      });
    } else {
      // Other chart types (same as original)
      const entries = cfg.data;
      new Chart(ctx, {
        type: cfg.type,
        data: {
          labels: entries.map(e => {
            const label = e.k;
            if ((cfg.id === 'chartOffice' || cfg.id === 'chartBarangay' || cfg.id === 'chartCC2') && label.length > 18) {
              const midpoint = Math.floor(label.length / 2);
              const spaceIndex = label.lastIndexOf(' ', midpoint);
              const splitIndex = spaceIndex > 0 ? spaceIndex : midpoint;
              return [label.slice(0, splitIndex).trim(), label.slice(splitIndex).trim()];
            }
            return label;
          }),
          datasets: [{
            data: entries.map(e => e.v),
            backgroundColor: [
              'rgba(0, 90, 156, 0.7)',
              'rgba(0, 163, 224, 0.7)',
              'rgba(70, 130, 180, 0.7)',
              'rgba(100, 149, 237, 0.7)',
              'rgba(30, 144, 255, 0.7)',
              'rgba(0, 191, 255, 0.7)'
            ],
            borderColor: [
              'rgba(0, 90, 156, 1)',
              'rgba(0, 163, 224, 1)',
              'rgba(70, 130, 180, 1)',
              'rgba(100, 149, 237, 1)',
              'rgba(30, 144, 255, 1)',
              'rgba(0, 191, 255, 1)'
            ],
            borderWidth: 1,
            hoverOffset: 10
          }]
        },
        options: {
          plugins: {
            title: { display: true, text: cfg.title, font: { size: 16, weight: 'bold' }, padding: { top: 10, bottom: 20 } },
            legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyle: 'circle' } }
          },
          responsive: true,
          maintainAspectRatio: false,
          animation: { duration: 1000, easing: 'easeOutQuart' },
          scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
            x: { grid: { display: false } }
          },
          elements: { arc: { borderWidth: 0 } }
        }
      });
    }
  });

  // Render suggestions and services (same as original)
  renderSuggestions(data);
  renderServices(data);
}

function renderSuggestions(data) {
  const suggestionList = document.getElementById('suggestionList');
  suggestionList.innerHTML = '';

  data.forEach(r => {
    const suggestion = r['SUGGESTIONS/COMMENTS:'] || r['Suggestions'] || '';
    const office = r['OFFICE:'] || 'Unknown Office';
    const date = formatPrettyDate(r['DATE:']);
    const email = r['EMAIL ADDRESS:'] || r['EMAIL'] || 'N/A';

    if (suggestion.trim()) {
      const li = document.createElement('li');
      li.innerHTML = `<strong>${office}</strong><small>${date}</small><p>${suggestion}</p><small style="color:#555;">-${email}</small>`;
      suggestionList.appendChild(li);
    }
  });

  const suggestionItems = suggestionList.querySelectorAll('li');
  const totalSuggestionHeight = Array.from(suggestionItems).reduce((acc, li) => acc + li.offsetHeight + 10, 0);
  
  if (totalSuggestionHeight > 250) {
    suggestionList.classList.add('scroll-animate');
  } else {
    suggestionList.classList.remove('scroll-animate');
  }
}

function renderServices(data) {
  const serviceList = document.getElementById('serviceList');
  serviceList.innerHTML = '';

  const services = data.map(r => {
    const office = r['OFFICE:'] || '';
    const service = r['SERVICE AVAILED:'] || '';
    const date = formatPrettyDate(r['DATE:']);

    if ((office || service) && date) {
      const li = document.createElement('li');
      li.innerHTML = `<strong>${office}</strong><br><small>${date}</small><br>${service}`;
      return li;
    }
    return null;
  }).filter(item => item);

  services.forEach(li => serviceList.appendChild(li));

  const totalHeight = services.reduce((acc, li) => acc + li.offsetHeight + 10, 0);
  if (totalHeight > 250) {
    serviceList.classList.add('scroll-animate');
  } else {
    serviceList.classList.remove('scroll-animate');
  }
}

// Initialize
loadData();