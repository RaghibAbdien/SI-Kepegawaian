// Show Password
document.addEventListener('DOMContentLoaded', function() {
	const passwordField = document.getElementById('password');
	const show = document.querySelector('#pass');
  
	show.addEventListener('click', function() {
	  const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
	  passwordField.setAttribute('type', type);
  
	  // Change eye icon based on password visibility
	  if (type === 'password') {
        show.classList.remove('fa-eye');
        show.classList.add('fa-eye-slash');
      } else {
        show.classList.remove('fa-eye-slash');
        show.classList.add('fa-eye');
      }
	});
  });