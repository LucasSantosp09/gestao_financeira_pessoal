(function ($) {
    

    // Chart Global Color
    Chart.defaults.color = "#6C7293";
    Chart.defaults.borderColor = "#000000";


    // Worldwide Sales Chart
    var ctx2 = $("#worldwide-sales2").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "bar",
        data: {
            labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dezembro"],
            datasets: [{
                    label: "Receitas",
                    data: [0, 3000],
                    backgroundColor: "rgba(14, 59, 232, 0.8)"
                },
                {
                    label: "Despesas",
                    data: [0, 2085],
                    backgroundColor: "rgba(235, 22, 22, .7)"
                },
                {
                    label: "Investimentos",
                    data: [0,0],
                    backgroundColor: "rgba(49, 237, 27, 0.8)"
                }
            ]
            },
        options: {
            responsive: true
        }
    });



    
})(jQuery);

