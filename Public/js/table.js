	$(function(){
		   var titles_total = $('td.title').length;
		    if (titles_total) { /* setting z-index for IE7 */
		        $('td.title').each(function (i, e) {
		            $(e).children('div').css('z-index', String(titles_total - i));
		        });

		        $('td.title').find('a').click(function () {
		            // hide previously opened containers
		            $('.opened').hide();
		            // remove highlighted class from rows
		            $('td.highlighted').removeClass('highlighted');

		            // locate the row we clicked onto
		            var tr = $(this).parents("tr");
		            var div = $(this).parent().find('.listingDetails');

		            if (!$(div).hasClass('opened')) {
		                $(div).addClass('opened').width($(tr).width() - 2).show();
		                $(tr).find('td').addClass('highlighted');
		            } else {
		                $(div).removeClass('opened');
		                $(tr).find('td').removeClass('highlighted');
		            }
		            return false;
		        });
		    }

	})