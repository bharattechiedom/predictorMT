//Sensor
$(document).ready(function () {
  $(".filter-button").click(function () {
    var value = $(this).attr("data-filter");

    if (value == "all-sensor") {
      //$('.filter').removeClass('hidden');
      $(".filter").show("1000");
    } else {
      //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
      //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
      $(".filter")
        .not("." + value)
        .hide("3000");
      $(".filter")
        .filter("." + value)
        .show("3000");
    }
  });

  //if ($(".filter-button").removeClass("active")) {
  //$(this).removeClass("active");
  //}
  //$(this).addClass("active");
});

//metter
$(document).ready(function () {
  $(".filter-button-metter").click(function () {
    var value = $(this).attr("data-filter");

    if (value == "all-metter") {
      //$('.filter').removeClass('hidden');
      $(".filter-metter").show("1000");
    } else {
      //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
      //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
      $(".filter-metter")
        .not("." + value)
        .hide("3000");
      $(".filter-metter")
        .filter("." + value)
        .show("3000");
    }
  });

  /*if ($(".filter-button-metter").removeClass("active")) {
	$(this).removeClass("active");
	}
	$(this).addClass("active");*/
});

//gateway
$(document).ready(function () {
  $(".filter-button-gateway").click(function () {
    var value = $(this).attr("data-filter");

    if (value == "all-gateway") {
      //$('.filter').removeClass('hidden');
      $(".filter-gateway").show("1000");
    } else {
      //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
      //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
      $(".filter-gateway")
        .not("." + value)
        .hide("3000");
      $(".filter-gateway")
        .filter("." + value)
        .show("3000");
    }
  });
  /* if ($(".filter-button-gateway").removeClass("active")) {
	$(this).removeClass("active");
	}
	$(this).addClass("active");*/
});
//for active

$(function () {
  $(".filter-button").click(function () {
    $(".filter-button.active").removeClass("active");
    $(this).addClass("active");
  });
});
