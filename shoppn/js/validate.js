const registerForm = document.getElementById('register-form');
const loginForm = document.getElementById('login-form');
if(registerForm){
    const emailErrorText = document.getElementById('email-regex-error');
    const contactErrorText = document.getElementById('contact-regex-error');
    const passErrorText = document.getElementById('pass-regex-error');

    registerForm.addEventListener('submit', function(e){
        emailErrorText.style.display = "none";
        contactErrorText.style.display = "none";
        passErrorText.style.display = "none";
    
        // Fetch values from the form inputs
        const emailInput = document.querySelector('.email-input');
        const contactInput = document.querySelector('.contact-input');
        const passInput = document.querySelector('.pass-input');

        // Define regex patterns
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const passRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
        const phoneRegex = /^[0-9+\-\s]{7,15}$/;

        // Test the values
        if(!emailRegex.test(emailInput.value)){
            e.preventDefault(); // Stops the form from submitting
            emailErrorText.style.display = "block";
            // emailInput.insertAdjacentHTML('afterend', "<p style='font-size: 10px'>Email Doesn't Reach Regex Requirements</p>");
        }

        if(!phoneRegex.test(contactInput.value)){
            e.preventDefault();
            contactErrorText.style.display = "block";
            // contactInput.insertAdjacentHTML('afterend', '<p>Phone Error</p>');
        }

        if(!passRegex.test(passInput.value)){
            e.preventDefault();
            passErrorText.style.display = "block";
        }
    });
}

if(loginForm){
    const emailErrorText = document.getElementById('email-regex-error');
    const passErrorText = document.getElementById('pass-regex-error');

    loginForm.addEventListener('submit', function(e){
        const emailInput = document.querySelector('.email-input');
        const passInput = document.querySelector('.pass-input');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const passRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
        emailErrorText.style.display = "none";

        if(!emailRegex.test(emailInput.value)){
            e.preventDefault(); // Stops the form from submitting
            emailErrorText.style.display = "block";
            // emailInput.insertAdjacentHTML('afterend', "<p style='font-size: 10px'>Email Doesn't Reach Regex Requirements</p>");
        }

        if(!passRegex.test(passInput.value)){
            e.preventDefault();
            passErrorText.style.display = "block";
        }
    })
}