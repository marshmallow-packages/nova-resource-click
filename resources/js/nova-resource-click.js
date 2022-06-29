import ResourceTableRow from './components/ResourceTableRow';

Nova.booting((app, router, store) => {
  app.component('ResourceTableRow', require('./components/ResourceTableRow').default);
});
