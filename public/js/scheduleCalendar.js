document.addEventListener('DOMContentLoaded', function() {
  let calendarEl = document.getElementById('memberSchedule');
  if (calendarEl !== null) {
    let dataSchedule = calendarEl.getAttribute('data-schedules');
    let events = JSON.parse(dataSchedule);
    let calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      header: {
        left: 'buttonNight buttonNoon',
        center: 'prev,title,next',
        right: ''
      },
      locale: calendarEl.getAttribute('data-lang'),
      navLinks: false, // can click day/week names to navigate views
      selectable: false,
      selectMirror: false,
      editable: false,
      eventLimit: true,
      events: events,
      eventRender: function(eventObj, $el) {
        eventObj.el.innerHTML = '<div class="fc-content">' + eventObj.event.title + '</div>';
      },
      customButtons: {
        buttonNight: {
          text: calendarEl.getAttribute('data-night-ok'),
        },
        buttonNoon: {
          text: calendarEl.getAttribute('data-noon-ok'),
        }
      },
      eventOrder: ['-id']
    });

    calendar.render();
  }
});
