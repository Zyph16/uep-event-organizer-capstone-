document.addEventListener("DOMContentLoaded", () => {

    const profileIcon = document.querySelector('.profile-icon');
    const profileDropdown = document.querySelector('.profile-dropdown');
    const token = localStorage.getItem('token');
    const profileContainer = document.getElementById('profile-container');

     
    
    if (token) {
        
        const logoutBtn = document.getElementById('logout-btn');
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            localStorage.removeItem('token');
            window.location.href = 'http://localhost/uep-event-booking/event-organizer-frontend/index.php';
        });

    } else {
        console.log('User is not logged in');

        
       profileContainer.innerHTML = ""; 

        const loginLink = document.createElement("a");
        loginLink.href = "/uep-event-booking/event-organizer-frontend/app/Login_SignupPage/Login_Signup.php?tab=login";
        loginLink.textContent = "Login";
        loginLink.classList.add("login-btn");

        const registerLink = document.createElement("a");
        registerLink.href = "/uep-event-booking/event-organizer-frontend/app/Login_SignupPage/Login_Signup.php?tab=register"; 
        registerLink.textContent = "Register";

        profileContainer.appendChild(loginLink);
        profileContainer.append(" | ");
        profileContainer.appendChild(registerLink);


    }

    profileIcon.addEventListener('click', () =>{
        const isVisible = profileDropdown.style.display === 'block';
        profileDropdown.style.display = isVisible ? 'none' : 'block';

        profileIcon.style.color = isVisible ? '' : '#1f3c88';
        // profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';

        // profileIcon.style.color = '#1f3c88';
    });
    requestAnimationFrame(() => {
        const rect = profileDropdown.getBoundingClientRect();

        if(rect.right > window.innerWidth ){
            profileDropdown.style.left = 'auto';
            profileDropdown.style.right= '0';
        }

        if(rect.left < 0 ){
            profileDropdown.style.left = '0';
            profileDropdown.style.right= 'auto';
        }
    });
    window.addEventListener('click', (e) => {
        if(!e.target.closest('.profile-container')){
            profileDropdown.style.display ='none';
             profileIcon.style.color = '';
        }
    })
 
  
})