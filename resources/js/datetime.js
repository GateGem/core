import flatpickr from "flatpickr";
if (window != undefined) {
  window.flatpickr = flatpickr;
  const loadEventDatetime = (el) => {
    el?.querySelectorAll(".el-date").forEach((elItem) => {
      flatpickr(elItem, {});
    });
  };
  window.addEventListener("load", function () {
    loadEventDatetime(document.body);
    Livewire.hook("message.processed", (message, component) => {
      loadEventDatetime(component.el);
    });
  });
  window.addEventListener("loadComponent", function ({ detail }) {
    loadEventDatetime(detail);
  });
}
