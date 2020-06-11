<div _ngcontent-yvb-c105="" class="row">
    <div _ngcontent-yvb-c105="" class="col-lg-12">
        <p _ngcontent-yvb-c105="" class="p-heading p-large" style="margin-bottom: 1rem; font-weight: bold;">
            Qui a dit qu'il fallait aller loin pour se sentir dépaysé ?</p>
        <h1 _ngcontent-yvb-c105="">
            L'aventure démarre !
            <br _ngcontent-yvb-c105="">
            <span _ngcontent-yvb-c105="" data-period="2000"
                data-rotate="[&quot;Exploration d'une grotte 🗺️&quot;, &quot;Route des vins 
							🍷&quot;, &quot;Journée canoë 🚣&quot;, &quot;Sur les traces des Gaulois 📜&quot;, &quot;Tour de montgolfière 🎈&quot;, &quot;Escapade gustative 🍽️&quot;]"
                class="txt-rotate">
                <span class="wrap">Escapade gustative 🍽️</span>
            </span>
            &nbsp;
        </h1>
    </div>
</div>

<script>
    var TxtRotate = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
    };

    TxtRotate.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 300 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
    }

    setTimeout(function() {
        that.tick();
    }, delta);
    };

    window.onload = function() {
    var elements = document.getElementsByClassName('txt-rotate');
    for (var i=0; i<elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-rotate');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
        new TxtRotate(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
    document.body.appendChild(css);
    };
</script>