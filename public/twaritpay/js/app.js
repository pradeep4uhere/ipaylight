(() => {
  "use strict";

  const header = document.getElementById("siteHeader");
  const nav = document.getElementById("mainNav");
  const toggle = document.getElementById("mobileToggle");
  const modal = document.getElementById("leadModal");
  const form = document.getElementById("leadForm");
  const message = document.getElementById("formMessage");

  document.getElementById("year").textContent = new Date().getFullYear();

  const setHeader = () => header.classList.toggle("scrolled", window.scrollY > 8);
  setHeader();
  window.addEventListener("scroll", setHeader, { passive: true });

  toggle.addEventListener("click", () => {
    const open = nav.classList.toggle("open");
    toggle.setAttribute("aria-expanded", String(open));
    toggle.textContent = open ? "×" : "☰";
  });

  nav.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", () => {
      nav.classList.remove("open");
      toggle.setAttribute("aria-expanded", "false");
      toggle.textContent = "☰";
    });
  });

  const openModal = () => {
    modal.hidden = false;
    document.body.classList.add("modal-open");
    modal.querySelector("input")?.focus();
  };

  const closeModal = () => {
    modal.hidden = true;
    document.body.classList.remove("modal-open");
  };

  document.querySelectorAll("[data-modal-open]").forEach(btn => {
    btn.addEventListener("click", openModal);
  });

  document.querySelectorAll("[data-modal-close]").forEach(el => {
    el.addEventListener("click", closeModal);
  });

  document.addEventListener("keydown", e => {
    if (e.key === "Escape" && !modal.hidden) closeModal();
  });

  form.addEventListener("submit", e => {
    e.preventDefault();

    const data = Object.fromEntries(new FormData(form).entries());

    // Replace this block with your Laravel/API endpoint.
    // Example:
    // fetch("/api/leads", {
    //   method: "POST",
    //   headers: {"Content-Type": "application/json", "X-CSRF-TOKEN": "..."},
    //   body: JSON.stringify(data)
    // });

    console.log("Lead submitted:", data);
    message.textContent = "Thank you! Your enquiry has been submitted.";
    form.reset();
  });

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll(".reveal").forEach(el => observer.observe(el));
})();
