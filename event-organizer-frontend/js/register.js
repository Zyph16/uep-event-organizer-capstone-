function attachRegisterHandler() {
    const form = document.getElementById("register-form");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault(); 

        const registerUser = {
                username    : document.getElementById("email_txt").value,
                first_name  : document.getElementById("firstname_txt").value,
                middle_name : document.getElementById("middlename_txt").value,
                last_name   : document.getElementById("lastname_txt").value,
                email       : document.getElementById("email_txt").value,
                phone       : document.getElementById("contactNo_txt").value,
                password    : document.getElementById("password_txt").value
            };


        try {
            const response = await fetch("http://localhost:8000/api/register", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(registerUser)
            });

            const data = await response.json();

            if (response.ok) {
                alert("Registration successful!");
                window.location.href = 
                "http://localhost/uep-event-booking/event-organizer-frontend/app/Login_SignupPage/Login_Signup.php";
            } else {
                alert("Registration Failed: " + (data.message || "Unknown error"));
            }
        } catch (error) {
            console.error("Error:", error);
            alert("An error occurred. Please try again");
        }
    });
}

// 👇 Listen for when SignUp.php gets injected
document.addEventListener("DOMContentLoaded", () => {
    const observer = new MutationObserver(() => {
        if (document.getElementById("register-form")) {
            attachRegisterHandler();
        }
    });

    observer.observe(document.getElementById("form-container"), { childList: true });
});
