import Tagify from "@yaireo/tagify";
if (window != undefined) {
  window.Tagify = Tagify;
  const loadEventDatetime = (el) => {
    el?.querySelectorAll(".el-tag").forEach((elItem) => {
      new Tagify(elItem, {});
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
