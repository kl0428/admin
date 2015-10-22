      var plot_statistics = $.plot($("#invest_graph"), [{
        data: graph_data,
        label: "投资"
      }
      ], {
        series: {
          lines: {
            show: true,
            lineWidth: 2, 
            fill: true,
            fillColor: {
              colors: [{
                opacity: 0.25
              }, {
                opacity: 0.25
              }
              ]
            } 
          },
          points: {
            show: true
          },
          shadowSize: 2
        },
        legend:{
          show: false
        },
        grid: {
        labelMargin: 10,
           axisMargin: 500,
          hoverable: true,
          clickable: true,
          tickColor: "rgba(0,0,0,0.15)",
          borderWidth: 0
        },
        colors: ["#50ACFE", "#4A8CF7", "#52e136"],
        xaxis: {
          ticks: 11,
          tickDecimals: 0
        },
        yaxis: {
          ticks: 5,
          tickDecimals: 0
        }
      });

    var previousPoint = null;
      $("#invest_graph").bind("plothover", function (event, pos, item) {
      
        var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";

        if (item) {
          if (previousPoint != item.dataIndex) {
            previousPoint = item.dataIndex;
            $("#tooltip").remove();
            var x = item.datapoint[0],
            new_x = ''+x+'';
            x = trans(new_x);
            y = item.datapoint[1].toFixed(2);
            showTooltip(item.pageX, item.pageY,
            '在'+x+item.series.label + y+'元');
          }
        } else {
          $("#tooltip").remove();
          previousPoint = null;
        }
      });

    function showTooltip(x, y, contents) {
      $("<div id='tooltip'>" + contents + "</div>").css({
        position: "absolute",
        display: "none",
        top: y + 5,
        left: x + 5,
        border: "1px solid #000",
        padding: "5px",
        'color':'#fff',
        'border-radius':'2px',
        'font-size':'11px',
        "background-color": "#000",
        opacity: 0.80
      }).appendTo("body").fadeIn(200);
    }
    function trans(x)
    {
        var year = x.substr(0,4);
        var month = x.substr(4,2);
        var date  = x.substr(6,2);
        var hour = x.substr(8,2);
        var min = x.substr(10,2);
        var sec = x.substr(12,2);
        return year+'年'+month+'月'+date+'日'+hour+'时'+min+'分'+sec+'秒';
    }