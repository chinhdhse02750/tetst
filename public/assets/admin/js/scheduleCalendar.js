document.addEventListener('DOMContentLoaded', function() {
  const IS_NOON_DATING = 0;
  const IS_NIGHT_DATING = 1;
  let calendarEl = document.getElementById('memberSchedule');
  if (calendarEl !== undefined || calendarEl) {
    let dataEdit = calendarEl.getAttribute('data-edit');
    let dataSchedule = calendarEl.getAttribute('data-schedules');
    let eventsEdit = JSON.parse(dataSchedule);
    let events = dataEdit ? eventsEdit : [];
    let calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      header: {
        left: 'buttonNight buttonNoon',
        center: 'prev,title,next',
        right: ''
      },
      locale: calendarEl.getAttribute('data-lang'),
      navLinks: false, // can click day/week names to navigate views
      selectable: true,
      height: dataEdit ? 650 : '100%',
      selectMirror: true,
      // editable: true,
      editable: false,
      eventLimit: true,
      events: events,
      selectAllow: function(select) {
        let format = 'YYYY/MM/DD';
        let selected = moment(select.start, format);
        let now = moment(new Date(), format);

        return now.diff(selected, 'days') <= 0
      },
      select: function (arg, jsEvent, view) {
        let startDate = new Date(arg.start).toJSON();
        let endDate = new Date(arg.end).toJSON();
        memberScheduleModal(startDate, endDate);
        getEventsEdit(calendar.getEvents(), arg);
      },
      eventClick: function(arg) {
        if (confirm('delete schedule?')) {
          deleteEventsSchedule(arg.event.id);
          resetForm();
        }
      },
      selectOverlap: function(event) {
        return ! event.block;
      },
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
      eventOrder: ['-id'],
      fixedWeekCount: false,
    });
    calendar.render();
    memberScheduleForm();

    function memberScheduleModal(startDate, endDate) {
      let memberScheduleModal = $('#memberScheduleModal');
      memberScheduleModal.modal('toggle');
      memberScheduleModal.on('shown.bs.modal', function (e) {
        $('#scheduleStartDate').val(startDate);
        $('#scheduleEndDate').val(endDate);
      });
      memberScheduleModal.on('hidden.bs.modal', resetForm);
    }

    function resetForm() {
      $('.js-submit-schedule').removeAttr('disabled');
      $('#scheduleStartDate').val('');
      $('#scheduleEndDate').val('');
      $("#memberScheduleForm")[0].reset();
    }

    function memberScheduleForm() {
      $("#memberScheduleForm").on('submit', function (e) {
        e.preventDefault();
        let data = $(this).serialize();
        saveSchedule(data);

        resetForm();
        $('#memberScheduleModal').modal('hide');
      });
    }

    function saveSchedule(data) {
      let result = [];
      let startDate, endDate, isNightDating, isNoonDating;
      let schedules = data.split('&');
      for (let value of schedules) {
        let itemSchedule = value.split('=');
        if (itemSchedule.indexOf('start_date') !== -1) {
          startDate = new Date(decodeURIComponent(itemSchedule[1]));
        }

        if (itemSchedule.indexOf('end_date') !== -1) {
          endDate = new Date(decodeURIComponent(itemSchedule[1]));
        }

        if (itemSchedule.indexOf('is_night_dating') !== -1) {
          isNightDating = {
            'title': '<div class="dating-type__title">' + calendarEl.getAttribute('data-night') + '</div>',
            'type': IS_NIGHT_DATING,
            'classNames': [
              'is_dating',
              'is_night_dating'
            ],
          };
        }

        if (itemSchedule.indexOf('is_noon_dating') !== -1) {
          isNoonDating = {
            'title': '<div class="dating-type__title">' + calendarEl.getAttribute('data-noon') + '</div>',
            'type': IS_NOON_DATING,
            'classNames': [
              'is_dating',
              'is_noon_dating'
            ],
          };
        }
      }

      if (startDate !== undefined && endDate !== undefined) {
        let formatDate = 'MM/DD/YYYY';
        let dataSchedule = {
          'start': startDate,
          'end': endDate,
          'local_start': moment(startDate.getTime(), 'x').format(formatDate),
          'local_end': moment(endDate.getTime(), 'x').format(formatDate),
          'start_time': startDate.getTime(),
          'end_time': endDate.getTime()
        };
        if (isNightDating !== undefined) {
          isNightDating = _.assign(isNightDating, {'id': 'night_' + startDate.getTime() + '_' + endDate.getTime()});
          result.push(_.assign(isNightDating, dataSchedule));
        }

        if (isNoonDating !== undefined) {
          isNoonDating = _.assign(isNoonDating, {'id': 'noon_' + startDate.getTime() + '_' + endDate.getTime()});
          result.push(_.assign(isNoonDating, dataSchedule));
        }

        if (isNightDating === undefined && isNoonDating === undefined) {
          result.push(_.assign({'id': -1}, dataSchedule));
        }
      }

      setEventsEdit(calendar.getEvents(), result);
    }

    function getEventsEdit(events, arg) {
      let isNightDating = 0;
      let isNoonDating = 0;
      for (let item of events) {
        if (item.id === 'night_' + arg.start.getTime() + '_' + arg.end.getTime()) {
          isNightDating = 1;
        }

        if (item.id === 'noon_' + arg.start.getTime() + '_' + arg.end.getTime()) {
          isNoonDating = 1;
        }
      }

      if (isNightDating) {
        $('#isNightDating').prop('checked', true);
      }

      if (isNoonDating) {
        $('#isNoonDating').prop('checked', true);
      }
    }

    function setEventsEdit(events, data) {
      let obj = [];
      let flagSetObj = 1;
      if (typeof data !== 'undefined' && data.length > 0) {
        for (let itemEvent of events) {
          if (_.filter(data, ['start_time', itemEvent.start.getTime()]).length &&
            _.filter(data, ['end_time', itemEvent.end.getTime()]).length &&
            !_.filter(data, ['id', itemEvent.id]).length
          ) {
            deleteEventsSchedule(itemEvent.id);
          }
        }

        for (let itemData of data) {
          if (itemData.id === -1) {
            flagSetObj = 0;
          }
        }

        if (flagSetObj) {
          obj = setObjSchedule(data);
        }
      } else {
        for (let item of events) {
          deleteEventsSchedule(item.id);
        }
      }

      calendar.addEventSource(flagSetObj ? obj : []);
    }

    function setObjSchedule(data) {
      let obj = [];
      for (let item of data) {
        let itemSchedule = calendar.getEventById(item.id);
        if (!itemSchedule) {
          obj.push({
            'title': item.title,
            'id': item.id,
            'classNames': item.classNames,
            'start': item.start,
            'end': item.end,
          });
          let data = JSON.stringify({
            'start_date': item.local_start,
            'end_date': item.local_end,
            'type': item.type,
            'id': item.id
          });
          addItemHtml(item.id, data);
        }
      }

      return obj;
    }

    function deleteEventsSchedule(id) {
      let itemSchedule = calendar.getEventById(id);
      let targetSchedule = $('#' + id);
      if (dataEdit) {
        let fillId = _.findIndex(events, function(e) {
          return e.id === id;
        });

        if (fillId !== -1) {
          targetSchedule.attr('name', 'user_schedule_delete[]');
          targetSchedule.val(id);
        } else {
          targetSchedule.remove()
        }
      } else {
        targetSchedule.remove()
      }
      itemSchedule.remove();
    }

    function addItemHtml(id, data) {
      let targetSchedule = $('#' + id);
      if (dataEdit) {
        if (targetSchedule.size()) {
          targetSchedule.attr('name', 'user_schedule[]');
          targetSchedule.val(data);
        } else {
          addHtml(id, data);
        }
      } else {
        addHtml(id, data);
      }
    }

    function addHtml(id, data) {
      $('#scheduleCalendarHidden').append(
        '<input type="hidden" name="user_schedule[]" value=\'' + data + '\' id="' + id + '">'
      );
    }
  }
});
