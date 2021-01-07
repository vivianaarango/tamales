window.onload = function() {
    axios.get('/api/reports/production/type')
        .then(function (response) {
            var labels = [];
            var data = [];
            var colors = [
                "#e7da0e",
                "#2fa50d",
                "#d42d3f",
                "#18a7ba",
                "#000000",
                "#FFFFFF",
                "#FF0000",
                "#1f0748",
                "#0000FF",
                "#ff5100",
                "#00FFFF",
                "#FF00FF"
            ];

            var result = response.data.data;
            console.log(result);
            for (i = 0; i < result.length; i++) {
                labels.push(result[i].name);
                data.push(result[i].quantity);
            }

            new Chart(document.getElementById("pie-chart"), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: colors,
                        data: data
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Producción por tipo de tamal'
                    }
                }
            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
}