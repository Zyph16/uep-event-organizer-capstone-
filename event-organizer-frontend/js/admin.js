// Highlight current nav link based on URL
document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll(".admin-nav a");
  const currentPath = window.location.pathname.split("/").pop();

  navLinks.forEach(link => {
    const linkPath = link.getAttribute("href").split("/").pop();
    if (linkPath === currentPath) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
});
