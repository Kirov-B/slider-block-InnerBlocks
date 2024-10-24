(function ($) {
  if (typeof $ === "undefined") {
    console.error("jQuery is not loaded. Slider initialization aborted.");
    return;
  }

  const config = {
    breakpoints: {
      tablet: 1024,
      mobile: 600,
    },
    defaultSlidesToShow: {
      desktop: 1,
      tablet: 1,
      mobile: 1,
    },
  };

  function initSlider($section) {
    let slider = $section
      .find(".slider-innerblocks")
      .find(".acf-innerblocks-container")
      .first();
    if (slider.hasClass("slick-initialized")) {
      return;
    }
    const slidesToShow =
      parseInt($section.data("slides-to-show"), 10) ||
      config.defaultSlidesToShow.desktop;
    const slidesToShowTablet =
      parseInt($section.data("slides-to-show-tablet"), 10) ||
      config.defaultSlidesToShow.tablet;
    const slidesToShowMobile =
      parseInt($section.data("slides-to-show-mobile"), 10) ||
      config.defaultSlidesToShow.mobile;
    const showArrows = $section.data("show-arrows");
    const showDots = $section.data("show-dots");

    const slickOptions = {
      slidesToShow: slidesToShow,
      slidesToScroll: 1,
      arrows: showArrows,
      dots: showDots,
      infinite: false,
      easing: "linear",
      edgeFriction: 0.35,
      touchMove: true,
      autoplay: true,
      autoplaySpeed: 3000,
      fade: false,
      fadeSpeed: 1000,
      adaptiveHeight: true,
      responsive: [
        {
          breakpoint: config.breakpoints.tablet,
          settings: {
            slidesToShow: slidesToShowTablet,
          },
        },
        {
          breakpoint: config.breakpoints.mobile,
          settings: {
            slidesToShow: slidesToShowMobile,
          },
        },
      ],
    };

    try {
      slider.slick(slickOptions);
    } catch (error) {
      console.error("Error initializing slider:", error);
    }
  }

  function initAllSliders() {
    $(".slider-innerblocks-section").each(function () {
      initSlider($(this));
    });
  }

  $(document).ready(initAllSliders);
})(jQuery);
