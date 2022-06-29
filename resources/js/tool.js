import ResourceTable from './components/ResourceTable';
import ResourceTableRow from './components/ResourceTableRow';

Nova.booting((app, router, store) => {
  app.component('ResourceTable', require('./components/ResourceTable').default);
  app.component('ResourceTableRow', require('./components/ResourceTableRow').default);
});
