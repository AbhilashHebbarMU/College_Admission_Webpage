// Add event listener to login form
document.querySelector('form').addEventListener('submit', (e) => {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // TO DO: Add authentication logic here
    // For now, just alert the username and password
    alert(`Username: ${username}, Password: ${password}`);
});
const form = document.getElementById('application-form');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const formData = new FormData(form);
  const data = {};
  for (const [key, value] of formData) {
    data[key] = value;
  }
  console.log(data);
  // Send data to server using AJAX or fetch API
  // For demo purposes, we'll just log the data to the console
});

