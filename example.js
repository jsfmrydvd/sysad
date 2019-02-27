angular.module('mwl.calendar.docs', ['mwl.calendar', 'ngAnimate', 'ui.bootstrap', 'colorpicker.module']);
angular
  .module('mwl.calendar.docs')
  .controller('KitchenSinkCtrl', function(moment, alert, calendarConfig) {

    var vm = this;
    vm.calendarView = 'year';
    vm.viewDate = new Date();

    vm.events = [{}, {}];
    console.log(vm.events);
    console.log(vm.events.length);
    vm.cellIsOpen = false;
    // $scope.month.badgeTotal = 3000;
    vm.addEvent = function() {
      // vm.events.push({
      //   title: 'New event',
      //   startsAt: moment().startOf('day').toDate(),
      //   endsAt: moment().endOf('day').toDate(),
      //   color: calendarConfig.colorTypes.important,
      //   draggable: true,
      //   resizable: true
      // });
    };
    // month.badgeTotal = 20;

    // vm.eventClicked = function(event) {
    //   alert.show('Clicked', event);
    // };
    //
    // vm.eventEdited = function(event) {
    //   alert.show('Edited', event);
    // };
    //
    // vm.eventDeleted = function(event) {
    //   alert.show('Deleted', event);
    // };
    //
    // vm.eventTimesChanged = function(event) {
    //   alert.show('Dropped or resized', event);
    // };

    // vm.toggle = function($event, field, event) {
    //   $event.preventDefault();
    //   $event.stopPropagation();
    //   event[field] = !event[field];
    // };

    // vm.timespanClicked = function(date, cell) {
    //
    //   if (vm.calendarView === 'month') {
    //     if ((vm.cellIsOpen && moment(date).startOf('day').isSame(moment(vm.viewDate).startOf('day'))) || cell.events.length === 0 || !cell.inMonth) {
    //       vm.cellIsOpen = false;
    //     } else {
    //       vm.cellIsOpen = true;
    //       vm.viewDate = date;
    //     }
    //   } else if (vm.calendarView === 'year') {
    //     if ((vm.cellIsOpen && moment(date).startOf('month').isSame(moment(vm.viewDate).startOf('month'))) || cell.events.length === 0) {
    //       vm.cellIsOpen = false;
    //     } else {
    //       vm.cellIsOpen = true;
    //       vm.viewDate = date;
    //     }
    //   }
    //
    // };

  });
