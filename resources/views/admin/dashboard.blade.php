@extends("admin.layout.app")

@section("css")
<link rel="stylesheet" type="text/css" href="/assets/admin/css/widgets.css" />
@append

@section("navbar")
  <h4>Dashboard</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="row cards">
        {{-- USERS TYPES COUNT CHART --}}

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="card chart full-height">
              <div class="card-content no-padding full-height flot-chart">
                <div id="user-types-chart" class="chart" style="height : 200px"></div>
                <div id="user-types-chart-legend" class="legend flex justify-center"></div>
              </div>
            </div>
        </div>


        {{-- CLOCK --}}
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="card full-height">
                <div class="card-content full-height">
                    @include("admin.widgets.clock")
                </div>
            </div>
        </div>
    </div>
  </div>
@stop

@section("javascript")
<script src="/assets/admin/js/jquery.flot.min.js"></script>
<script src="/assets/admin/js/jquery.flot.pie.min.js"></script>
<script>
function legendFormatter(label, series) {
    return '<div ' +
           'style="font-size:8pt;text-align:center;padding:2px;">' +
           label + ' ' + Math.round(series.percent)+'%</div>';
}
var plot = $.plot("#user-types-chart", [], {
    series : {
        pie : {
            show   : true,
            radius : 1,
            label  : {
                show       : true,
                radius     : 0.5,
            }
        }
    },
    legend: {
        show      : true,
        noColumns : 0,
        container : $("#user-types-chart-legend")
    },
    grid : {
        hoverable : true
    }
});

$(window).resize(function () {
    var width = $(".flot-chart .chart").width()
    $(".flot-chart .chart > *").width(width);
    plot.resize();
    plot.draw();
});
</script>
@append