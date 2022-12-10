import Alpine from "alpinejs";
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;
window.Alpine = Alpine;

Alpine.start();
if (document.querySelector('meta[name="web_url"]'))
  window.web_base_url = document
    .querySelector('meta[name="web_url"]')
    .getAttribute("value");
import "whatwg-fetch";
import "./loader";
import "./component";
import "./confirm";
import "./treeview";
import "./datetime";
import "./tagify";
import "./quill/index";

if (window) {
  window.ShowFileManager = (callback) => {
    window.eventSelectFile = undefined;
    window.loadComponentTo("core::common.filemanager", undefined);
    window.eventSelectFile = (path) => {
      if (callback) callback(path);
      window.eventSelectFile = undefined;
      const filemanager = livewire.components.getComponentsByName(
        "core::common.filemanager"
      );
      if (filemanager.length > 0) {
        window.removeComponent(filemanager[filemanager.length - 1].id);
      }
    };
  };
}
