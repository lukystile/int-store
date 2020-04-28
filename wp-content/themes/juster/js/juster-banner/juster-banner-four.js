jQuery(document).ready(function($){

    var width, height, largeHeader, largeSubpage, canvas, ctx, lines, target, size, animateHeader = true;

    // Main
    initHeader();
    addListeners();
    initAnimation();

    function initHeader() {
        if ($('body').hasClass('is_front_page')){
            sub_height = $( ".slider-container" ).height();
            sub_width = $( ".slider-container" ).width();
            width = window.sub_width;
            height = window.sub_height;
            size = width > height ? height : width;
            target = {x: 0, y: height};

            largeHeader = document.getElementById('large-header');
            largeHeader.style.height = height+'px';

            canvas = document.getElementById('juster-canvas-four');
            canvas.width = width;
            canvas.height = height;
            ctx = canvas.getContext('2d');
        } else {
            sub_height = $( ".slider-container" ).height();
            sub_width = $( ".slider-container" ).width();
            width = window.sub_width;
            height = window.sub_height;
            size = width > height ? height : width;
            target = {x: 0, y: height};

            if ($('body').hasClass('jt_agency_content')) {
                largeSubpage = document.getElementById('sub-page-spl-banner');
                largeSubpage.style.height = height+'px';
            }

            canvas = document.getElementById('juster-canvas-four');
            canvas.width = width;
            canvas.height = height;
            ctx = canvas.getContext('2d');
        }

        // create particles
        lines = [];
        for(var i = 0; i < 90; i++) {
            var l = new Line(Math.random()*360);
            lines.push(l);
        }
    }

    function initAnimation() {
        animate();
    }

    // Event handling
    function addListeners() {
        window.addEventListener('scroll', scrollCheck);
        window.addEventListener('resize', resize);
    }

    function scrollCheck() {
        if(document.body.scrollTop > height) animateHeader = false;
        else animateHeader = true;
    }

    function resize() {
        if ($('body').hasClass('is_front_page')){
            sub_height = $( ".slider-container" ).height();
            sub_width = $( ".slider-container" ).width();
            width = window.sub_width;
            height = window.sub_height;
            size = width > height ? height : width;
            largeHeader.style.height = height+'px';
            canvas.width = width;
            canvas.height = height;
        } else {
            sub_height = $( ".slider-container" ).height();
            sub_width = $( ".slider-container" ).width();
            width = window.sub_width;
            height = window.sub_height;
            size = width > height ? height : width;
            largeHeader.style.height = height+'px';
            canvas.width = width;
            canvas.height = height;
        }
    }

    function animate() {
        if(animateHeader) {
            ctx.clearRect(0,0,width,height);
            for(var i in lines) {
                if(i < lines.length){
                    lines[i].draw();
                }
            }
        }
        requestAnimationFrame(animate);
    }

    // Canvas manipulation
    function Line(angle) {
        var _this = this;

        // constructor
        (function() {
            _this.angle = angle;

        })();

        this.draw = function() {

            var r1 = Math.random()*(size < 400 ? 400 : size)*0.4;
            var r2 = Math.random()*(size < 400 ? 400 : size)*0.4;
            var x1 = r1*Math.cos(_this.angle*(Math.PI/180)) + width*0.5;
            var y1 = r1*Math.sin(_this.angle*(Math.PI/180)) + height*0.48;
            var x2 = r2*Math.cos(_this.angle*(Math.PI/180)) + width*0.5;
            var y2 = r2*Math.sin(_this.angle*(Math.PI/180)) + height*0.48;
            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.lineTo(x2, y2);
            ctx.strokeStyle = 'rgba(190,190,190,'+(0.5+Math.random()*0.5)+')';

            ctx.stroke();
            ctx.beginPath();
            ctx.arc(x1, y1, 2, 0, 2 * Math.PI, false);
            ctx.fillStyle = 'rgba(190,190,190,'+(0.5+Math.random()*0.5)+')';
            ctx.fill();

            _this.angle += Math.random();
        };
    }

});