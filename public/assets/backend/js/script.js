var options = {
    series: [],
    chart: {
      type: 'bar',
      height: 400,
      stacked: true,
      toolbar: { show: false },
      zoom: { enabled: false }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        borderRadius: 8,
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'last',
        columnWidth: '30%',
      }
    },
    dataLabels: { enabled: false },
    xaxis: { categories: [] },
    legend: {
      position: 'top',
      horizontalAlign: 'center',
      markers: { radius: 12 }
    },
    colors: ['#6A00FF', '#FFA500', '#00C49F'],
    fill: { opacity: 1 },
    grid: { borderColor: '#f1f1f1' }
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();

  var data = {
    day: {
      categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      series: [
        { name: 'New Customer', data: [20, 40, 30, 50, 40, 30, 20] },
        { name: 'Man Customer', data: [10, 20, 15, 25, 20, 15, 10] },
        { name: 'Woman Customer', data: [15, 30, 20, 35, 30, 20, 15] }
      ]
    },
    month: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      series: [
        { name: 'New Customer', data: [100, 200, 150, 100, 120, 200, 220, 240, 130, 250, 180, 160] },
        { name: 'Man Customer', data: [200, 220, 180, 200, 100, 250, 300, 200, 100, 320, 250, 140] },
        { name: 'Woman Customer', data: [150, 300, 250, 200, 180, 220, 270, 150, 90, 250, 200, 180] }
      ]
    },
    year: {
      categories: ['2020', '2021', '2022', '2023', '2024'],
      series: [
        { name: 'New Customer', data: [600, 800, 900, 750, 880] },
        { name: 'Man Customer', data: [700, 900, 950, 800, 950] },
        { name: 'Woman Customer', data: [500, 850, 920, 780, 900] }
      ]
    }
  };

  function updateChart(range, element = null) {
  document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));

  if (element) {
    element.classList.add('active'); // On button click
  }

  chart.updateOptions({
    xaxis: { categories: data[range].categories },
    series: data[range].series
  });
}


  /// Load default (Month)
document.addEventListener('DOMContentLoaded', function () {
  const defaultBtn = document.querySelector('.toggle-btn:nth-child(2)'); // Assuming second button is 'Month'
  defaultBtn.classList.add('active');
  updateChart('year');
});








//   =============  Progress Bar  ===================



// Select all progress bar containers
var progressContainers = document.querySelectorAll('.container.chart');

// Define an array of colors
var colors = ['#fff', '#EA410B', '#4D13F1', '#EA900B', '#13BF99', '#4D13F1'];

// Loop through each container and create a progress bar
progressContainers.forEach(function (container, index) {
    var current = parseInt(container.getAttribute('data-current'));
    var target = parseInt(container.getAttribute('data-target'));

    // Calculate the percentage (max 100%)
    var percentage = Math.min((current / target) * 100, 100);

    // Select the color based on index
    var color = colors[index % colors.length];

    // Create the progress bar
    var bar = new ProgressBar.Circle(container, {
        strokeWidth: 10,
        trailWidth: 10,
        easing: 'easeInOut',
        duration: 1400,
        text: {
            value: '0%',
            className: 'progress-text',
            style: {
                color: '#000',
                position: 'absolute',
                left: '50%',
                top: '50%',
                padding: 0,
                margin: 0,
                transform: 'translate(-50%, -50%)',
                fontSize: '1.5rem',
                fontFamily: '"Raleway", Helvetica, sans-serif'
            }
        },
        // Important: Apply the color here
        from: { color: color, width: 10 },
        to: { color: color, width: 10 },
        step: function (state, circle) {
            // Set the stroke color dynamically
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);
            circle.path.setAttribute('stroke-linecap', 'round');

            var value = Math.round(circle.value() * 100);
            if (value === 0) {
                circle.setText('0%');
            } else {
                circle.setText(value + '%');
            }
        }
    });

    // Animate to the calculated percentage
    bar.animate(percentage / 100);
});




// Side Bar clickable Button

const menuBtn = document.getElementById('menuBtn');
const sidebar = document.querySelector('.side_bar .hidden');
const overlay = document.getElementById('overlay');

// Toggle sidebar and overlay
menuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
});

// Hide sidebar and overlay when clicking outside
overlay.addEventListener('click', () => {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
});



