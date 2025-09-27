<template>
	<form-edit with-helpdesk>
		<template v-slot:default="{ record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field label="Name" v-model="record.name"></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-data-table
							v-model="record.selected"
							:headers="record.headers"
							:items="record.items"
							density="compact"
							item-value="value"
							hide-default-footer
							show-select
						></v-data-table>
					</v-col>
				</v-row>
			</v-card-text>
		</template>
	</form-edit>
</template>

<script>
export default {
	name: "procurement-type-edit",
};
</script>
