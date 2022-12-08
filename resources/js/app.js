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