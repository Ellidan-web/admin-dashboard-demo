const endpoint = "./js/sampledata.json";
let dataRaw = [];

// Event listeners
document.getElementById('applyFilter').onclick = renderResponses;
document.getElementById('resetFilter').onclick = () => {
  document.getElementById('officeSelect').value = '';
  renderResponses();
};

// Load data
async function loadData() {
  const resp = await fetch(endpoint);
  dataRaw = await resp.json();
  renderResponses();
}

// Filter by office
function filterByOffice(data) {
  const office = document.getElementById('officeSelect').value;
  if (!office) return data;
  
  return data.filter(r => {
    const recordOffice = (r['OFFICE:'] || '').trim();
    return recordOffice === office;
  });
}

// Group responses
function groupResponses(data, questionKey) {
  const counts = {};
  data.forEach(r => {
    const response = r[questionKey] || 'No response';
    counts[response] = (counts[response] || 0) + 1;
  });

  const total = data.length;
  const entries = Object.entries(counts).map(([response, count]) => ({
    response,
    count,
    percentage: total > 0 ? (count / total * 100).toFixed(1) : 0
  }));

  entries.sort((a, b) => b.count - a.count);
  return { entries, total };
}

// Create question element
function createQuestionElement(questionKey, questionText, responses) {
  const container = document.createElement('div');
  container.className = 'response-container';
  
  const title = document.createElement('div');
  title.className = 'question-title';
  title.textContent = questionText;
  container.appendChild(title);
  
  const table = document.createElement('table');
  table.className = 'response-table';
  
  const thead = document.createElement('thead');
  thead.innerHTML = `
    <tr>
      <th>Response</th>
      <th>Count</th>
      <th>Percentage</th>
      <th>Visual</th>
    </tr>
  `;
  table.appendChild(thead);
  
  const tbody = document.createElement('tbody');
  responses.entries.forEach(item => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${item.response}</td>
      <td>${item.count}</td>
      <td>${item.percentage}%</td>
      <td>
        <div class="percentage-bar">
          <div class="percentage-fill" style="width: ${item.percentage}%"></div>
        </div>
      </td>
    `;
    tbody.appendChild(row);
  });
  table.appendChild(tbody);
  container.appendChild(table);
  
  const total = document.createElement('div');
  total.className = 'total-responses';
  total.textContent = `Total Responses: ${responses.total}`;
  container.appendChild(total);
  
  return container;
}

// Render responses
function renderResponses() {
  const data = filterByOffice(dataRaw);
  const container = document.getElementById('responsesContainer');
  container.innerHTML = '';
  
  const questions = [
    { key: 'CLIENT TYPE:', text: 'Client Type' },
    { key: 'SEX:', text: 'Sex' },
    { key: 'AGE:', text: 'Age' },
    { key: 'BARANGAY IN NAGA CITY:', text: 'Barangay in Naga City' },
    { key: 'CC1:', text: 'CC1: Awareness of City Government Programs' },
    { key: 'CC2:', text: 'CC2: Visibility of City Government Programs' },
    { key: 'CC3:', text: 'CC3: Helpfulness of City Government Programs' },
    { key: 'SQD0', text: 'SQD0: Overall Satisfaction' },
    { key: 'SQD1', text: 'SQD1: Ease of Transaction' },
    { key: 'SQD2', text: 'SQD2: Quality of Service' },
    { key: 'SQD3', text: 'SQD3: Time of Transaction' },
    { key: 'SQD4', text: 'SQD4: Staff Competence' },
    { key: 'SQD5', text: 'SQD5: Physical Setup' },
    { key: 'SQD6', text: 'SQD6: Information Provided' },
    { key: 'SQD7', text: 'SQD7: Courtesy of Staff' },
    { key: 'SQD8', text: 'SQD8: Overall Experience' },
    { key: 'SERVICE AVAILED:', text: 'Service Availed' }
  ];
  
  questions.forEach(q => {
    const responses = groupResponses(data, q.key);
    if (responses.total > 0) {
      const element = createQuestionElement(q.key, q.text, responses);
      container.appendChild(element);
    }
  });
  
  // Handle suggestions/comments
  const suggestions = data.filter(r => r['SUGGESTIONS/COMMENTS:'] || r['Suggestions']);
  if (suggestions.length > 0) {
    const suggestionsContainer = document.createElement('div');
    suggestionsContainer.className = 'response-container';
    
    const title = document.createElement('div');
    title.className = 'question-title';
    title.textContent = 'Suggestions/Comments';
    suggestionsContainer.appendChild(title);
    
    const table = document.createElement('table');
    table.className = 'response-table';
    
    const thead = document.createElement('thead');
    thead.innerHTML = `
      <tr>
        <th>Office</th>
        <th>Date</th>
        <th>Suggestion/Comment</th>
      </tr>
    `;
    table.appendChild(thead);
    
    const tbody = document.createElement('tbody');
    suggestions.forEach(r => {
      const row = document.createElement('tr');
      const date = new Date(r['DATE:']).toLocaleDateString();
      row.innerHTML = `
        <td>${r['OFFICE:'] || 'Unknown'}</td>
        <td>${date}</td>
        <td>${r['SUGGESTIONS/COMMENTS:'] || r['Suggestions']}</td>
      `;
      tbody.appendChild(row);
    });
    table.appendChild(tbody);
    suggestionsContainer.appendChild(table);
    
    const total = document.createElement('div');
    total.className = 'total-responses';
    total.textContent = `Total Suggestions/Comments: ${suggestions.length}`;
    suggestionsContainer.appendChild(total);
    
    container.appendChild(suggestionsContainer);
  }
}

// Initialize
loadData();