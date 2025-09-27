<template>
	<form-show with-helpdesk>
		<template v-slot:default="{ record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field
							label="Name"
							v-model="record.name"
							readonly
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-data-table
							v-model="record.selected"
							:headers="record.headers"
							:items="record.documents"
							density="compact"
							item-value="value"
							hide-default-footer
							readonly
						></v-data-table>
					</v-col>
				</v-row>
			</v-card-text>
		</template>

		<template v-slot:helpdesk></template>
	</form-show>
</template>

<script>
export default {
	name: "procurement-type-show",
};
</script>
