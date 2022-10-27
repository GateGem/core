if (document.querySelector('meta[name="web_url"]'))
  window.web_base_url = document
    .querySelector('meta[name="web_url"]')
    .getAttribute("value");
import "whatwg-fetch";
import "./loader";
import "./component";
import "./confirm";
