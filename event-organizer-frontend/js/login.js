
  const links = document.querySelectorAll(".tabs a");
  const indicator = document.querySelector(".active-indicator");
  const content = document.getElementById("form-container");

  function moveIndicator(el) {
    const rect = el.getBoundingClientRect();
    const navRect = el.parentElement.getBoundingClientRect();
    indicator.style.left = (rect.left - navRect.left) + "px";
    indicator.style.width = rect.width + "px";
  }

  function attachLoginHandler() {
    const form = document.getElementById("login-form");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      try {
        const response = await fetch("http://localhost:8000/api/login", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ username, password })
        });

        const data = await response.json();

        if (response.ok) {
          localStorage.setItem("token", data.access_token);
          window.location.href =
            "http://localhost/uep-event-booking/event-organizer-frontend/index.php";
        } else {
          alert("Login failed: " + (data.message || "Unknown Error"));
        }
      } catch (error) {
        console.error("Error:", error);
        alert("An error occurred while logging in.");
      }
    });
  }

  function loadPage(url) {
    fetch(url)
      .then(res => res.text())
      .then(html => {
        content.innerHTML = html;
        attachLoginHandler(); // 👈 re-bind after loading
      })
      .catch(err => {
        content.innerHTML = "<p style='color:red'>Failed to load content.</p>";
        console.error(err);
      });
  }

  // Initial load
  const active = document.querySelector(".tabs a.active");
  if (active) {
    moveIndicator(active);
    loadPage(active.getAttribute("href"));
  }

  // Tab clicks
  links.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();

      document.querySelector(".tabs a.active").classList.remove("active");
      link.classList.add("active");
      moveIndicator(link);
      loadPage(link.getAttribute("href"));
    });
  });

  // 👇 Extra: check query string (?tab=register)
  const params = new URLSearchParams(window.location.search);
  const tab = params.get("tab");

  if (tab === "register") {
    const registerLink = document.querySelector('.tabs a[href*="SignUp.php"]');
    if (registerLink) {
      document.querySelector(".tabs a.active").classList.remove("active");
      registerLink.classList.add("active");
      moveIndicator(registerLink);
      loadPage(registerLink.getAttribute("href"));
    }
  } else {
    const active = document.querySelector(".tabs a.active");
    if(active) {
      moveIndicator(active);
      loadPage(active.getAttribute("href"))
    }
  }

