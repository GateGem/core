if (window != undefined) {
  const checkClassOrParent = (e, className) => {
    return (
      e.target.classList.contains(className) ||
      e.target.parentElement.classList.contains(className)
    );
  };
  const eventClickTreeview = (e) => {
    if (
      checkClassOrParent(e, "icon-open") ||
      checkClassOrParent(e, "icon-close")
    ) {
      const li = e.target.closest("li");
      if (li.classList.contains("show")) li.classList.remove("show");
      else li.classList.add("show");
      const wireElent = e.target.closest("[wire\\:id]");
      if (wireElent) {
        const eventChangeExpand = e.target
          .closest(".tree-view")
          ?.getAttribute("tree-event-expand");
        if (eventChangeExpand) {
          let valueInput = li.querySelector("input")
            ? li.querySelector("input").value
            : li.querySelector(".label-item").getAttribute("value");
          window.livewire
            .find(wireElent.getAttribute("wire:id"))
            [eventChangeExpand](valueInput, li.classList.contains("show"));
        }
      }
    }
  };
  const eventChangeCheckRootInput = (e) => {
    const li = e.target.closest("li");
    const wireElent = e.target.closest("[wire\\:id]");
    if (wireElent) {
      const wireComponent =
        livewire.components.componentsById[wireElent.getAttribute("wire:id")];
      if (wireComponent) {
        li.querySelectorAll("ul input").forEach((el) => {
          el.checked = e.target.checked;
          el.dispatchEvent(new Event("input"));
          if (el.getAttribute("wire:model.defer")) {
            wireComponent.set(
              el.getAttribute("wire:model.defer"),
              el.checked ? el.value : false,
              true
            );
          }
        });
        return;
      }
    }
    li.querySelectorAll("ul input").forEach((el) => {
      el.checked = e.target.checked;
      el.dispatchEvent(new Event("input"));
    });
  };
  const eventChangeCheckInput = (e) => {
    const treeView = e.target.closest(".tree-view");
    isCheckTreeView(treeView);
  };
  const loadEventTreeview = (el) => {
    el?.querySelectorAll(".tree-view").forEach((elItem) => {
      elItem.removeEventListener("click", eventClickTreeview);
      elItem.addEventListener("click", eventClickTreeview);
      elItem.querySelectorAll(".cbk_root").forEach((elCheckInput) => {
        elCheckInput.removeEventListener("change", eventChangeCheckRootInput);
        elCheckInput.addEventListener("change", eventChangeCheckRootInput);
      });
      elItem.querySelectorAll(".form-check-input").forEach((elCheckInput) => {
        elCheckInput.removeEventListener("change", eventChangeCheckInput, true);
        elCheckInput.addEventListener("change", eventChangeCheckInput);
      });
      isCheckTreeView(elItem);
    });
  };
  const isCheckTreeView = (itemView) => {
    itemView
      .querySelectorAll(":scope > ul > li > .form-check > .cbk_root")
      .forEach((item) => {
        item.checked = isCheckRoot(item);
      });
  };
  const isCheckRoot = (el) => {
    let elLi = el.closest("li");
    let arrRoot = elLi.querySelectorAll(
      " :scope > ul > li > .form-check > .cbk_root"
    );
    if (arrRoot.length == 0) {
      let arrInput = elLi.querySelectorAll(
        ":scope > ul > li > .form-check > .form-check-input"
      );
      if (arrInput.length == 0) return false;
      return (
        arrInput.length ==
        [...arrInput].filter((item) => item.checked == true).length
      );
    }

    el.checked =
      arrRoot.length ==
      [...arrRoot].filter((item) => {
        item.checked = isCheckRoot(item);
        return item.checked;
      }).length;
    return el.checked;
  };
  window.addEventListener("load", function () {
    loadEventTreeview(document.body);
    Livewire.hook("message.processed", (message, component) => {
      loadEventTreeview(component.el);
    });
  });
  window.addEventListener("loadComponent", function ({ detail }) {
    loadEventTreeview(detail);
  });
}
