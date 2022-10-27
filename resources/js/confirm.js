import Swal from "sweetalert2";
import MethodAction from "./_part/method";

let initConfirm = () => {
  window.initLivewireConfirm = true;
  window.addEventListener("swal-message", async (event) => {
    return await Swal.fire(event.detail);
  });
  if (Livewire) {
    Livewire.components.registerDirective(
      "confirm",
      function (el, directive, component) {
        const confirmNoIcon = el.getAttribute("data-confirm-no-icon") ?? false;
        const confirmTitle = el.getAttribute("data-confirm-title") ?? "";
        const confirmMessage = el.getAttribute("data-confirm-message") ?? "";
        const confirmYes = el.getAttribute("data-confirm-yes") ?? "Yes";
        const confirmNo = el.getAttribute("data-confirm-no") ?? "No";
        const event = "click";
        const handler = (e) => {
          Swal.fire({
            padding: "0.75rem",
            icon: confirmNoIcon ? "" : "question",
            title: confirmTitle,
            text: confirmMessage,
            cancelButtonText: confirmNo,
            showCancelButton: true,
            confirmButtonText: confirmYes,
          })
            .then(function ({ isConfirmed }) {
              if (isConfirmed) {
                component.callAfterModelDebounce(() => {
                  directive.setEventContext(e);

                  // This is outside the conditional below so "wire:click.prevent" without
                  // a value still prevents default.

                  const method = directive.method;
                  let params = directive.params;

                  if (
                    params.length === 0 &&
                    e instanceof CustomEvent &&
                    e.detail
                  ) {
                    params.push(e.detail);
                  }
                  // Check for global event emission.
                  if (method === "$emit") {
                    component.scopedListeners.call(...params);
                    Livewire.components.emit(...params);
                    return;
                  }

                  if (method === "$emitUp") {
                    Livewire.components.emitUp(el, ...params);
                    return;
                  }

                  if (method === "$emitSelf") {
                    Livewire.components.emitSelf(component.id, ...params);
                    return;
                  }

                  if (method === "$emitTo") {
                    Livewire.components.emitTo(...params);
                    return;
                  }

                  if (directive.value) {
                    component.addAction(new MethodAction(method, params, el));
                  }
                });
              }
            })
            .catch(function (e) {});

          return;
        };
        const debounce = (func, wait, immediate) => {
          var timeout;
          return function () {
            var context = this,
              args = arguments;
            var later = function () {
              timeout = null;
              if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
          };
        };
        const debounceIf = (condition, callback, time) => {
          return condition ? debounce(callback, time) : callback;
        };

        const hasDebounceModifier = directive.modifiers.includes("debounce");
        const debouncedHandler = debounceIf(
          hasDebounceModifier,
          handler,
          directive.durationOr(150)
        );
        el.addEventListener(event, debouncedHandler);

        component.addListenerForTeardown(() => {
          el.removeEventListener(event, debouncedHandler);
        });
      }
    );
  }
};
if (!window.initLivewireConfirm) initConfirm();
