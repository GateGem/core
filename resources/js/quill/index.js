import Quill from "quill";
import ImageResize from "./modules/image/index";

if (window != undefined) {
  window.Quill = Quill;
  window.Quill.register("modules/imageResize", ImageResize);
  var toolbarOptions = [
    [{ font: [] }, { size: [] }],
    ["bold", "italic", "underline", "strike"],
    [{ color: [] }, { background: [] }],
    [{ script: "super" }, { script: "sub" }],
    [{ header: "1" }, { header: "2" }, "blockquote", "code-block"],
    [
      { list: "ordered" },
      { list: "bullet" },
      { indent: "-1" },
      { indent: "+1" },
    ],
    ["direction", { align: [] }],
    ["link", "image", "video", "formula"],
    ["clean"],
  ];
  var optionsQuill = {
    modules: {
      imageResize: {
        displaySize: true,
        resize: true,
      },
      toolbar: toolbarOptions,
    },
    placeholder: "Content ...",
    theme: "snow",
  };
  const loadEventQuill = (el) => {
    el?.querySelectorAll(".el-quill").forEach((elItem) => {
      var elContainer = elItem;
      if (elItem.type == "textarea") {
        elContainer = document.createElement("div");
        elContainer.innerHTML = elItem.value;
        elItem.parentNode.insertBefore(elContainer, elItem.nextSibling);
        elItem.style.display = "none";
      }
      var elQuill = new Quill(elContainer, optionsQuill);
      elQuill.on("text-change", function (delta, oldDelta, source) {
        elItem.value = elQuill.root.innerHTML;
        elItem.dispatchEvent(new Event("input"));
      });
      elQuill.getModule("toolbar").addHandler("image", () => {
        let selectIndex=elQuill.getSelection()??0;
        window.ShowFileManager(function (path) {
          elQuill.insertText(selectIndex, path);
        });
      });
      elItem.classList.remove("el-quill");
    });
  };
  window.addEventListener("load", function () {
    loadEventQuill(document.body);
    Livewire.hook("message.processed", (message, component) => {
      loadEventQuill(component.el);
    });
  });
  window.addEventListener("loadComponent", function ({ detail }) {
    loadEventQuill(detail);
  });
}
