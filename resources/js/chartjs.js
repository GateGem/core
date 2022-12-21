import Chart from "chart.js/auto";
if (window != undefined) {
  window.Chart = Chart;
  const loadEventChart = (el) => {
    el?.querySelectorAll(".el-chartjs").forEach((elItem) => {
      let content = JSON.parse(
        JSON.stringify(
          livewire.components.findComponent(elItem.getAttribute("data-wire-id"))
            .data[elItem.getAttribute("data-config")]
        )
      );
      if (window.GateChart == undefined) window.GateChart = [];
      if (window.GateChart[elItem.id] == undefined)
        window.GateChart[elItem.id] = new Chart(elItem, {
          ...content,
          responsive: true,
        });
      else {
        // window.GateChart[elItem.id].data.datasets=content.data.datasets;
        window.GateChart[elItem.id].data.datasets.forEach((item, index) => {
          item.data = content.data.datasets[index].data;
          item.label = content.data.datasets[index].label;
        });
        window.GateChart[elItem.id].data.labels = content.data.labels;
        window.GateChart[elItem.id].update('none');
      }
    });
    // window.addEventListener('resize', function(event) {
    // }, true);
  };
  window.addEventListener("load", function () {
    loadEventChart(document.body);
    // let instTimeout = undefined;
    // window.addEventListener("resize", () => {
    //   if (instTimeout != undefined) {
    //     clearTimeout(instTimeout);
    //   }
    //   instTimeout = setTimeout(() => {
    //     for (let id in Chart.instances) {
    //       setTimeout(() => {
    //         Chart.instances[id].resize();
    //       });
    //     }
    //     if (instTimeout != undefined) {
    //       clearTimeout(instTimeout);
    //     }
    //   }, 50);
    // });
    Livewire.hook("message.processed", (message, component) => {
      loadEventChart(component.el);
    });
  });
  window.addEventListener("loadComponent", function ({ detail }) {
    loadEventChart(detail);
  });
}
