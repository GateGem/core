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
          Object.keys(item).forEach((key) => {
            item[key] = content.data.datasets[index][key];
          });
        });
        window.GateChart[elItem.id].data.labels = content.data.labels;
        window.GateChart[elItem.id].update();
      }
    });
    // window.addEventListener('resize', function(event) {
    // }, true);
  };
  window.addEventListener("load", function () {
    loadEventChart(document.body);
    Livewire.hook("message.processed", (message, component) => {
      loadEventChart(component.el);
    });
  });
  window.addEventListener("loadComponent", function ({ detail }) {
    loadEventChart(detail);
  });
}
