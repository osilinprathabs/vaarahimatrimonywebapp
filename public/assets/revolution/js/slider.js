var revapi2,

  tpj;

jQuery(function() {
    tpj = jQuery;
    if(tpj("#rev_slider_1_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_1_1");
    }else{
    revapi1 = tpj("#rev_slider_1_1").show().revolution({
        sliderLayout:"fullwidth",
        visibilityLevels:"1240,1240,778,480",
        gridwidth:"1240,1240,778,480",
        gridheight:"750,750,450,350",
        spinner:"spinner0",
        perspective:600,
        perspectiveType:"local",
        editorheight:"750,768,450,350",
        responsiveLevels:"1240,1240,778,480",
        progressBar:{disableProgressBar:true},
        navigation: {
          onHoverStop:false,
          arrows: {
            enable:true,
            style:"uranus",
            hide_onmobile:true,
            hide_under:778,
            hide_onleave:true,
            left: {
              h_offset:30
            },
            right: {
              h_offset:30
            }
          }
        },
        fallbacks: {
          allowHTML5AutoPlayOnAndroid:true
        },
    });
  }
  
});


  jQuery(function() {
    tpj = jQuery;

    if(tpj("#rev_slider_2_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_2_1");

      }else{

        revapi2 = tpj("#rev_slider_2_1").show().revolution({
        sliderLayout:"fullwidth",
          visibilityLevels:"1240,1240,778,480",
          gridwidth:"1240,1240,778,480",
          gridheight:"845,845,450,350",
          spinner:"spinner0",
          perspective:600,
          perspectiveType:"local",
          editorheight:"845,768,450,350",
          responsiveLevels:"1240,1240,778,480",
          progressBar:{disableProgressBar:true},
          navigation: {
            onHoverStop:false
          },
          fallbacks: {
            allowHTML5AutoPlayOnAndroid:true
          },
      });
    }
  });


jQuery(function() {
    tpj = jQuery;

    if(tpj("#rev_slider_3_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_3_1");

      }else{

        revapi3 = tpj("#rev_slider_3_1").show().revolution({
        sliderType:"carousel",
        sliderLayout:"fullwidth",
        visibilityLevels:"1240,1240,778,480",
        gridwidth:"1240,1240,720,720",
        gridheight:"700,700,450,350",
        perspective:600,
        perspectiveType:"local",
        editorheight:"700,405,450,350",
        responsiveLevels:"1240,1240,778,480",
        progressBar:{disableProgressBar:true},
        stopAtSlide:0,
        stopAfterLoops:0,
        stopLoop:true,
        carousel: {
          infinity:true,
          fadeout:false
        },
        navigation: {
          mouseScrollNavigation:false,
          onHoverStop:false,
          touch: {
            touchenabled:true,
            swipe_min_touches:50
          },
          arrows: {
            enable:true,
            style:"custom",
            left: {
              h_offset:30
            },
            right: {
              h_offset:30
            }
          }
        },
        parallax: {
          levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
          type:"mouse",
          origo:"slidercenter",
          speed:2000
        },
        fallbacks: {
          allowHTML5AutoPlayOnAndroid:true
        },
      });
    }
  });



jQuery(function() {
    tpj = jQuery;

    if(tpj("#rev_slider_4_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_3_1");

      }else{

        revapi4 = tpj("#rev_slider_4_1").show().revolution({
        sliderLayout:"fullwidth",
        visibilityLevels:"1240,1240,778,480",
        gridwidth:"1240,1240,778,480",
        gridheight:"845,845,450,350",
        spinner:"spinner0",
        perspective:600,
        perspectiveType:"local",
        editorheight:"845,768,450,350",
        responsiveLevels:"1240,1240,778,480",
        progressBar:{disableProgressBar:true},
        navigation: {
          onHoverStop:false,
          bullets: {
            enable:true,
            tmp:"<span class=\"tp-bullet-image\"></span><span class=\"tp-bullet-imageoverlay\"></span><span class=\"tp-bullet-title\">{{title}}</span>",
            style:"zeus",
            hide_onmobile:true,
            hide_under:778,
            hide_onleave:true
          }
        },
        fallbacks: {
          allowHTML5AutoPlayOnAndroid:true
        },
      });
    }
  });
