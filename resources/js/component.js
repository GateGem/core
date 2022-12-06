import loader from "./loader";
import { getCsrfToken } from "./util/getCsrfToken";
import { htmlToElement } from "./util/html";
const loadComponentTo = (name, param, toEl) => {
  let csrfToken = getCsrfToken();
  fetch(`${web_base_url}gategem/livewire/component/${name}`, {
    method: "POST",
    credentials: "same-origin",
    body: JSON.stringify({
      param,
    }),
    headers: {
      "Content-Type": "application/json",
      Accept: "text/html, application/xhtml+xml",
      "X-Lara-Core": true,
      Referer: window.location.href,
      ...(csrfToken && { "X-CSRF-TOKEN": csrfToken }),
      // ...(socketId && { 'X-Socket-ID': socketId })
    },
  })
    .then(async (response) => {
      if (response.ok) {
        let data = await response.json();
        let el = htmlToElement(data.html);
        toEl.appendChild(el);
        livewire.rescan();
        loadEventComponent(el);
        window.dispatchEvent(new CustomEvent("loadComponent", { detail: el }));
      }
      loader.close();
    })
    .catch((er) => {
      loader.close();
    });
};
const eventClickLoadComponent = (e) => {
  let elModal = e.currentTarget;
  let strModal = elModal.getAttribute("wire:component");
  let targetTo = elModal.getAttribute("component:target");

  if (targetTo) {
    try {
      targetTo = document.querySelector(targetTo);
    } catch {}
  }
  if (!targetTo) {
    targetTo = document.body;
  }
  let rs = strModal.match(/(.*?)\((.*)\)/);
  if (elModal.hasAttribute("component:loading")) {
    loader.open();
  }
  if (rs) loadComponentTo(rs[1], rs[2], targetTo);
  else loadComponentTo(strModal, undefined, targetTo);
};
let loadEventComponent = (el) => {
  el.querySelectorAll("[wire\\:component]").forEach((elItem) => {
    elItem.removeEventListener("click", eventClickLoadComponent, true);
    elItem.addEventListener("click", eventClickLoadComponent);
  });
  if (el.classList.contains("modal")) {
    let modal = bootstrap?.Modal?.getInstance(el);
    if (modal) return;
    modal = bootstrap?.Modal?.getOrCreateInstance(el);
    if (modal) {
      modal.show();
      el.addEventListener("hidden.bs.modal", function () {
        removeComponent(el.getAttribute("wire:id"));
      });
    }
  }
};
let removeComponent = (componentId) => {
  if (!componentId) return;
  let liveComponent = window.Livewire.components.findComponent(componentId);
  if (liveComponent) {
    window.Livewire.components.removeComponent(liveComponent);
  }
  let elComponent = document.querySelector('[wire\\:id="' + componentId + '"]');
  if (elComponent) {
    const modal = bootstrap?.Modal?.getOrCreateInstance(elComponent);
    modal?.hide();
    setTimeout(() => {
      //modal?.dispose();
      elComponent.remove();
    });
  }
};
if (window != undefined) {
  window.addEventListener("load", function load() {
    loadEventComponent(document.body);
    Livewire.hook("message.processed", (message, component) => {
      loadEventComponent(component.el);
    });
  });

  window.addEventListener("remove_component", (event) =>
    removeComponent(event.detail.id)
  );
  window.loadComponentTo = loadComponentTo;
  window.removeComponent = removeComponent;
  window.addEventListener("reload_component", function (e) {
    if (e.detail.module) {
      Livewire.emit("refreshData" + e.detail.module);
    }
    if (e.detail.id) {
      Livewire.emit("refreshData" + e.detail.id);
    }
  });
}
