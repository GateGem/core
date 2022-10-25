let sidebarSwitch = () => {
  if (document.body.classList.contains("is-sidebar-mini")) {
    document.body.classList.remove("is-sidebar-mini");
  } else {
    document.body.classList.add("is-sidebar-mini");
  }
};
document.addEventListener("DOMContentLoaded", function () {
  let el = document.querySelector(".menu-sidebar");
  if (el) {
    el.addEventListener("mouseover", function (e) {
      let menuItem = e.target.closest(".menu-item");
      if (menuItem && (!menuItem.classList.contains('active')||document.body.classList.contains("is-sidebar-mini"))) {
        menuItem.querySelector(".menu").style.top =
          menuItem.offsetTop + 40 + "px";
      }
    });
  }
});
window.sidebarSwitch = sidebarSwitch;
