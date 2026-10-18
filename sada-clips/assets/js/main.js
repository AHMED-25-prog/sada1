(() => {
  "use strict";
  const header = document.querySelector(".site-header");
  const scroll = () =>
    header?.classList.toggle("scrolled", window.scrollY > 24);
  scroll();
  window.addEventListener("scroll", scroll, { passive: true });
  const toggle = document.querySelector(".menu-toggle"),
    nav = document.querySelector("#primary-nav");
  function closeMenu() {
    nav?.classList.remove("is-open");
    toggle?.setAttribute("aria-expanded", "false");
  }
  toggle?.addEventListener("click", () => {
    const open = toggle.getAttribute("aria-expanded") !== "true";
    toggle.setAttribute("aria-expanded", String(open));
    nav?.classList.toggle("is-open", open);
  });
  nav?.addEventListener("click", (e) => {
    if (e.target.closest("a")) closeMenu();
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeMenu();
  });
  const dialog = document.querySelector("#search-dialog"),
    search = document.querySelector(".search-toggle");
  search?.addEventListener("click", () => {
    if (dialog?.showModal) {
      dialog.showModal();
      dialog.querySelector("input")?.focus();
    }
  });
  dialog
    ?.querySelector(".dialog-close")
    ?.addEventListener("click", () => dialog.close());
  dialog?.addEventListener("click", (e) => {
    if (e.target === dialog) {
      const r = dialog.getBoundingClientRect();
      if (
        e.clientX < r.left ||
        e.clientX > r.right ||
        e.clientY < r.top ||
        e.clientY > r.bottom
      )
        dialog.close();
    }
  });
  dialog?.addEventListener("close", () => search?.focus());
})();

(() => {
  "use strict";
  let timer;
  const toast = (message) => {
    const el = document.querySelector(".toast");
    if (!el) return;
    el.textContent = message;
    el.classList.add("is-visible");
    clearTimeout(timer);
    timer = setTimeout(() => el.classList.remove("is-visible"), 5000);
  };
  document.addEventListener("click", async (e) => {
    const button = e.target.closest(".share-button");
    if (!button) return;
    const url = button.dataset.url,
      title = button.dataset.title;
    if (navigator.share) {
      try {
        await navigator.share({ title, url });
        return;
      } catch (error) {
        if (error.name === "AbortError") return;
      }
    }
    try {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(url);
      } else {
        const field = document.createElement("textarea");
        field.value = url;
        field.style.position = "fixed";
        field.style.opacity = "0";
        document.body.append(field);
        field.select();
        const ok = document.execCommand("copy");
        field.remove();
        if (!ok) throw new Error("copy");
      }
      toast(sadaMessages.copied);
    } catch {
      toast(sadaMessages.failed);
      const field = document.createElement("input");
      field.type = "text";
      field.value = url;
      field.readOnly = true;
      field.setAttribute("aria-label", title);
      button.after(field);
      field.focus();
      field.select();
      field.addEventListener("blur", () => field.remove(), { once: true });
    }
  });
  if (
    "IntersectionObserver" in window &&
    !matchMedia("(prefers-reduced-motion: reduce)").matches
  ) {
    const observer = new IntersectionObserver(
      (entries) =>
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.remove("is-waiting");
            observer.unobserve(entry.target);
          }
        }),
      { threshold: 0.05 },
    );
    document.querySelectorAll(".reveal").forEach((el) => {
      el.classList.add("is-waiting");
      observer.observe(el);
    });
  }
})();

document.addEventListener("click", (event) => {
  const button = event.target.closest(".load-video");
  if (!button) return;
  const url = new URL(button.dataset.src);
  if (!["www.youtube-nocookie.com", "player.vimeo.com"].includes(url.hostname))
    return;
  const frame = document.createElement("iframe");
  frame.src = url.href;
  frame.title = button.dataset.title;
  frame.allow = "fullscreen; picture-in-picture";
  frame.allowFullscreen = true;
  frame.referrerPolicy = "strict-origin-when-cross-origin";
  button.closest(".video-consent").replaceWith(frame);
});
