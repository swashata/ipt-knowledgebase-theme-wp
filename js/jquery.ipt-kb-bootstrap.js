(function($) {
	var methods = {
		init: function() {
			return this.each(function() {
				methods.applyPopover.apply(this);
				methods.applyTooltip.apply(this);
			});
		},

		// Apply Modal
		applyModal : function() {

		},

		// Apply Dropdown
		applyDropdown : function() {

		},

		// Apply Scrollspy
		applyScrollspy : function() {

		},

		// Apply Tab
		applyTab : function() {

		},

		// Apply Tooltip
		applyTooltip : function() {
			$(this).find('.bstooltip').tooltip();
		},

		// Apply Popover
		applyPopover : function() {
			var _self = this;
			$(this).on('click', '.ipt-kb-popover', function(e) {
				e.preventDefault();
				var status = $(this).data('activePopover');
				if ( undefined === status ) {
					var title = $(this).attr('title');
					$(this).attr('title', '');
					// Initialize
					var _self = this;
					$(this).popover({
						title : '<button type="button" class="btn pull-right btn-xs btn-default" id="' + $(this).data('popt') + '-close"><span class="glyphicon glyphicon-remove"></span></button>' +
								title,
						content : $('#' + $(this).data('popt')).html(),
						html : true,
						container : 'body'
					});
					$(document).on('click', '#' + $(this).data('popt') + '-close', function(e) {
						$(_self).popover('toggle');
					});

					// Show it
					$(this).popover('show');
					$(this).data('activePopover', true);
				}
			});
		},

		// Apply alert
		applyAlert : function() {

		},

		// Apply button
		applyButton : function() {

		},

		// Apply collapse
		applyCollapse : function() {

		},

		// Apply carousel
		applyCarousel : function() {

		},

		// Apply Affix
		applyAffix : function() {

		}
	};

	$.fn.iptKBBootstrap = function(method) {
		if(methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof(method) == 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.iptKBBootstrap');
			return this;
		}
	};
})(jQuery);

jQuery(document).ready(function($) {
	$(document).iptKBBootstrap();
});
