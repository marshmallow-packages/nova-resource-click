<script>
import { mapProps, InteractsWithResourceInformation } from '@/mixins';
import ResourceTableRow from '@/components/ResourceTableRow';
import { Inertia } from '@inertiajs/inertia';

export default {
  name: 'ResourceTableRow',

  mixins: [InteractsWithResourceInformation],

  extends: ResourceTableRow,

  props: {
    ...mapProps([
      'resource',
      'viaResource',
      'viaResourceId',
      'viaRelationship',
      'resourceName',
      'actionsAreAvailable',
      'actionsEndpoint',
      'onClickAction',
    ]),
  },

  methods: {
    navigateToDetail(e) {
      return this.resourceClickAction(e);
    },

    resourceClickAction(e) {
      let action = this.clickAction;

      if (action == 'undefined') {
        action = Nova.config('ResourceClickDefault');
      }

      if (action === 'update') {
        return this.navigateToUpdateView(e);
      } else if (action === 'select') {
        return this.toggleSelection();
      } else if (action === 'ignore') {
        return;
      } else if (action === 'view') {
        return this.navigateToDetailView(e);
      } else {
        return this.navigateToDetailView(e);
      }
    },

    navigateToDetailView(e) {
      if (!this.resource.authorizedToView) {
        return;
      }

      this.commandPressed ? window.open(this.viewURL, '_blank') : Inertia.visit(this.viewURL);
    },

    navigateToUpdateView(e) {
      if (!this.resource.authorizedToUpdate) {
        return;
      }

      this.commandPressed ? window.open(this.updateURL, '_blank') : Inertia.visit(this.updateURL);
    },
  },

  computed: {
    /**
     * Determine the action of the click on the resource table row.
     */
    clickAction() {
      if (this.resourceInformation.onClickAction && this.resourceInformation.onClickAction !== 'undefined') {
        return this.resourceInformation.onClickAction;
      }

      return Nova.config('ResourceClickDefault');
    },

    updateURL() {
      return this.$url(`/resources/${this.resourceName}/${this.resource.id.value}/edit`, {
        viaResource: this.viaResource,
        viaResourceId: this.viaResourceId,
        viaRelationship: this.viaRelationship,
      });
    },
  },
};
</script>
