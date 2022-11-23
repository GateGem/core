import { getCsrfToken } from "../getCsrfToken";
let switchSidebar = () => {
  if (document.body.classList.contains("is-sidebar-mini")) {
    document.body.classList.remove("is-sidebar-mini");
  } else {
    document.body.classList.add("is-sidebar-mini");
  }
  let csrfToken = getCsrfToken();
  fetch(`${web_base_url}lara/switchSidebar`, {
    method: "POST",
    credentials: "same-origin",
    body: JSON.stringify({}),
    headers: {
      "Content-Type": "application/json",
      Accept: "text/html, application/xhtml+xml",
      "X-Lara-Core": true,
      Referer: window.location.href,
      ...(csrfToken && { "X-CSRF-TOKEN": csrfToken }),
      // ...(socketId && { 'X-Socket-ID': socketId })
    },
  });
};
document.addEventListener("DOMContentLoaded", function () {
  let el = document.querySelector(".menu-sidebar");
  if (el) {
    el.addEventListener("mouseover", function (e) {
      let menuItem = e.target.closest(".menu-item");
      if (!menuItem) return;
      if (
        menuItem.classList.contains("active") &&
        window.innerWidth > 700 &&
        !document.body.classList.contains("is-sidebar-mini")
      )
        return;
      if (
        menuItem.classList.contains("active") &&
        window.innerWidth < 700 &&
        document.body.classList.contains("is-sidebar-mini")
      )
        return;

      let menu = menuItem.querySelector(".menu");
      if (menu) {
        menu.setAttribute("style", "top:" + (menuItem.offsetTop + 40) + "px");
        menuItem.addEventListener("mouseleave", function (e) {
          if (menu) menu.removeAttribute("style");
        });
      }
    });
  }
});
window.switchSidebar = switchSidebar;
