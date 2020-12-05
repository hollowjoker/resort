</div>
<div class="clr"></div>
</div>
</div>
<div class="clr"></div>
<div id="footer">
 <p class="fl-left">Web and Mobile Based Room And Event Reservation and Management System for Resorts</p>
 <p class="fl-right">Creative Techies</p>
</div>
</body>

<script>
    $(function () {
        $('.notification-holder').click(function () {
            $(this).find('.notification-menu').toggleClass('show');
            $.post('../admin/getRequests.php',{
                requestType: 'readNotification'
            }).done(function (returnData) {
                getNotif();
            });
        });

        setInterval(function () {
            getNotif();
        }, 5000);

        getNotif();

        function getNotif() {
            $.post('../admin/getRequests.php',{
                requestType: 'getNotification'
            }).done(function (returnData) {
                const data = JSON.parse(returnData);
                if (returnData.length) {
                    let toAppend = '';
                    let closed = 0;
                    data.forEach((inData) => {
                        let icon = '';
                        if (inData.type == 1) {
                            icon = 'mobile';
                        } else if (inData.type == 2) {
                            icon = 'wifi';
                        }
                        if (inData.status == 0) {
                            closed += 1;
                        }
                        toAppend += `
                        <li class="border-${icon}">
                            <div class="detail-holder">
                                <span>${inData.first_name} ${inData.surname} - Room # ${inData.room_no}</span>
                                <span>
                                    <i class="fa fa-${icon}" style="margin-right: 5px; font-size: 16px"></i>
                                    <span>${inData.message}</span>
                                </span>
                                <span><i class="fa fa-clock-o" style="margin-right: 5px;"></i>${moment(inData.date_created).fromNow()}</span>
                            </div>
                        </li>`;
                    });
                    $('.notification-menu ul').html(toAppend);
                    $('[data-badge="count"]').removeClass('show');
                    if (closed > 0) {
                        $('[data-badge="count"]').addClass('show');
                    }
                    $('[data-badge="count"]').text(closed);
                }
            });
        }
    });
</script>
</html>