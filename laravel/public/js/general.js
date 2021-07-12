// script pour gérer la carte et les détails

(function () {
	//is mobile
	var isMobile = { 
		Android: function() { return navigator.userAgent.match(/Android/i); }, 
		BlackBerry: function() { return navigator.userAgent.match(/BlackBerry/i); }, 
		iOS: function() { return navigator.userAgent.match(/iPhone|iPad|iPod/i); }, 
		Opera: function() { return navigator.userAgent.match(/Opera Mini/i); }, 
		Windows: function() { return navigator.userAgent.match(/IEMobile/i); }, 
		any: function() { return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows()); } 
	};
	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
	var isMac = navigator.platform.indexOf('Mac') > -1;
	var isIEorEDGE = navigator.appName == 'Microsoft Internet Explorer' || (navigator.appName == "Netscape" && navigator.appVersion.indexOf('Edge') > -1);
	
	//wait until resize is done
	window.addEventListener('resize', function() {
		if(this.resizeTO) clearTimeout(this.resizeTO);
		this.resizeTO = setTimeout(function() { 
			triggerEvent(this, 'resizeEnd');
		}, 500);
	});
	//wait until scroll is done
	window.addEventListener('scroll', function() {
		if(this.scrollTO) clearTimeout(this.scrollTO);
		this.scrollTO = setTimeout(function() {
			triggerEvent(this, 'scrollEnd');
		}, 500);
	});
	//triggerEvent
	function triggerEvent(el, type){
	   if ('createEvent' in document) {
			var e = document.createEvent('HTMLEvents');
			e.initEvent(type, false, true);
			el.dispatchEvent(e);
		}
		else {
			var e = document.createEventObject();
			e.eventType = type;
			el.fireEvent('on' + e.eventType, e);
		}
	}
		
	//closest polyfill (for IE9+)
	if (!Element.prototype.matches){
		Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
	}
	if (!Element.prototype.closest){
		Element.prototype.closest = function(s) {
			var el = this;
			if (!document.documentElement.contains(el)) return null;
			do {
				if (el.matches(s)) return el;
				el = el.parentElement || el.parentNode;
			} while (el !== null && el.nodeType == 1); 
			return null;
		};
	}
	
	//animation and transion end event
	function whichAnimationEvent(){
		var t,
		el = document.createElement("fakeelement");
		var animations = {
			"animation"      : "animationend",
			"OAnimation"     : "oAnimationEnd",
			"MozAnimation"   : "animationend",
			"WebkitAnimation": "webkitAnimationEnd"
		}
		for (t in animations){
			if (el.style[t] !== undefined){
				return animations[t];
			}
		}
	}
	var animationEvent = whichAnimationEvent();

	function whichTransitionEvent(){
		var t,
		el = document.createElement("fakeelement");
		var transitions = {
			"transition"      : "transitionend",
			"OTransition"     : "oTransitionEnd",
			"MozTransition"   : "transitionend",
			"WebkitTransition": "webkitTransitionEnd"
		}
		for (t in transitions){
			if (el.style[t] !== undefined){
				return transitions[t];
			}
		}
	}
	var transitionEvent = whichTransitionEvent();
	
	document.addEventListener("DOMContentLoaded", function () {
		// No action on empty links :
		var emptyLinks = document.querySelectorAll('a[href="#"]');
		if(emptyLinks){
			emptyLinks.forEach(function(elt){
				elt.addEventListener('click', function(event) {
					event.preventDefault();
				});
			});
		}
		
		var w = window,
			d = document,
			e = d.documentElement,
			g = d.getElementsByTagName('body')[0];
		var windowHeight = w.innerHeight||e.clientHeight||g.clientHeight;
		var windowWidth = w.innerWidth||e.clientWidth||g.clientWidth;
		
		var mobileLimit = 1024;
		var isDesktopContext = !isMobile.any() || windowWidth >= mobileLimit || (isiPad && windowWidth >= mobileLimit);
		var isMobileContext = isMobile.any() || windowWidth < mobileLimit;
		
		function windowResized(){
			windowHeight = w.innerHeight||e.clientHeight||g.clientHeight;
			windowWidth = w.innerWidth||e.clientWidth||g.clientWidth;
			isDesktopContext = !isMobile.any() || windowWidth >= mobileLimit || (isiPad && windowWidth >= mobileLimit);
			isMobileContext = isMobile.any() || windowWidth < mobileLimit;
		}
		windowResized();
		
		//wait until resize is done
		window.addEventListener('resize', function() {
			if(this.resizeTO) clearTimeout(this.resizeTO);
			this.resizeTO = setTimeout(function() { 
				triggerEvent(this, 'resizeEnd');
			}, 500);
		});
		window.addEventListener('resizeEnd', function() {
			//console.log("resizeEnd");
			windowResized();
		});
		
		//object-fit ruse for IE and Edge or any navigator that doesn't understand object-fit
		//var isSafari = (navigator.userAgent.toLowerCase().indexOf('safari/') > -1 && navigator.userAgent.toLowerCase().indexOf('chrome/') < 0);
		if('objectFit' in document.documentElement.style === false) {
			var liste = document.querySelectorAll('.js-object-fit');
			liste.forEach(function(elt){
				var imgUrl = elt.querySelector('img').getAttribute('src');
				if (imgUrl) {
					elt.style.backgroundImage = 'url(' + imgUrl + ')';
					elt.style.backgroundPosition = (elt.getAttribute('data-bg-pos')) ? elt.getAttribute('data-bg-pos') : '50% 50%';
					elt.style.backgroundRepeat = 'no-repeat';
					elt.style.backgroundSize = 'cover';
					elt.classList.add('compat-object-fit');
				}
			});
		}
		
		//interactive-map
		var isDetailOpened = false;
		function pozDetail(e){
			var that = e.currentTarget;
			var detail = document.getElementById(that.getAttribute('id') + '-detail');
			var detailW = (detail.offsetWidth == 0) ? 300 : detail.offsetWidth;
			var detailH = (detail.offsetHeight == 0) ? 50 : detail.offsetHeight;
			var pox = that.getBoundingClientRect().left - that.parentElement.parentElement.getBoundingClientRect().left - (detailW/2);
			var x = e.pageX;
			var y = e.pageY + 20;
			pox = x - that.parentElement.parentElement.getBoundingClientRect().left - (detailW/2);
			pox = (pox < 0) ? 0 : pox;
			pox = (pox + detailW > windowWidth) ? 0 : pox;
			var poy = that.getBoundingClientRect().top - that.parentElement.parentElement.getBoundingClientRect().top;
			poy = y - (that.parentElement.parentElement.getBoundingClientRect().top + window.pageYOffset);
			poy = (that.getBoundingClientRect().top - that.parentElement.parentElement.getBoundingClientRect().top > that.parentElement.parentElement.offsetHeight - 200) ? poy - (detailH*1.5) : poy;
			detail.style.left = pox + 'px';
			detail.style.top = poy + 'px';
		}
		if(isDesktopContext){
			if(isSafari){
				var details = document.querySelectorall('.interactive-map .region-detail');
				details.forEach(function(elt){
					elt.classList.add('no-transition');
				});
			}
			var regions = document.querySelectorAll('.interactive-map .map .region');
			regions.forEach(function(elt){
				elt.addEventListener('mouseover', function(e){
					e.preventDefault();
					if(!isDetailOpened){
						pozDetail(e);
						var that = e.currentTarget;
						var detail = document.getElementById(that.getAttribute('id') + '-detail');
						detail.classList.add('visible');
					}
				});
				elt.addEventListener('mouseleave', function(e){
					e.preventDefault();
					var that = e.currentTarget;
					if(that.getAttribute('data-opened') !== 'opened'){
						var detail = document.getElementById(that.getAttribute('id') + '-detail');
						detail.classList.remove('opened');
						detail.classList.remove('visible');
					}
				});
				elt.addEventListener('mousemove', function(e){
					e.preventDefault();
					if(!isDetailOpened){
						pozDetail(e);
					}
				});
			});
		}
		var regions = document.querySelectorAll('.interactive-map .map .region');
		regions.forEach(function(elt){
			elt.addEventListener('click', function(e){
				e.preventDefault();
				var detailOpened = document.querySelector('.interactive-map .map .region-detail.opened');
				if(detailOpened){
					detailOpened.classList.remove('visible')
					detailOpened.classList.remove('opened');
				}
				var region = document.querySelector('.interactive-map .map .region[data-opened=opened]');
				if(region){
					region.setAttribute('data-opened', 'false');
				}
				var that = e.currentTarget;
				that.setAttribute('data-opened', 'opened');
				var detail = document.getElementById(that.getAttribute('id') + '-detail');
				detail.style = '';
				detail.classList.add('visible');
				detail.classList.add('opened');
				function setPoz() {
					var t = detail.getBoundingClientRect().top;
					var b = detail.getBoundingClientRect().bottom;
					var limitT = 0;
					var limitB = windowHeight;
					if(t <= limitT){
						var delta = Math.abs(t) + limitT + 10;
						detail.style.top = 'calc(50% + ' + delta + 'px)';
					}
					else if(b > limitB){
						var delta = b - limitB + 10;
						detail.style.top = 'calc(50% - ' + delta + 'px)';
					}
				};
				if(isDesktopContext){
					var tempo = (isDetailOpened) ? 0 : (isSafari) ? 0 : 600
					setTimeout(setPoz, tempo);
				}
				isDetailOpened = true;
				document.removeEventListener('click', closeRegion);
				setTimeout(function(){
					document.addEventListener('click', closeRegion);
				}, 600);
			});
		});
		function closeRegion(e) {
			var isInDetail = e.target.closest('.region-detail');
			if(!isInDetail){
				isDetailOpened = false;
				var detailOpened = document.querySelector('.interactive-map .map .region-detail.opened');
				if(detailOpened){
					detailOpened.classList.remove('visible')
					detailOpened.classList.remove('opened');
				}
				var region = document.querySelector('.interactive-map .map .region[data-opened=opened]');
				if(region){
					region.setAttribute('data-opened', 'false');
				}
				document.removeEventListener('click', closeRegion);
			}
		}
		
		var closes = document.querySelectorAll('.interactive-map .region-detail .close');
		closes.forEach(function(elt){
			elt.addEventListener('click', function(e){
				e.preventDefault();
				var that = e.currentTarget;
				that.parentElement.classList.remove('visible');
				that.parentElement.classList.remove('opened');
				var region = document.getElementById(that.parentElement.getAttribute('id').replace('-detail', ''));
				region.setAttribute('data-opened', 'false');
				document.removeEventListener('click', closeRegion);
				isDetailOpened = false;
			});
		});
	});
})();