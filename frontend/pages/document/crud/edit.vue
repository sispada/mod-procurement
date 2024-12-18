<template>
	<form-edit with-helpdesk>
		<template v-slot:default="{ record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field
							label="Name"
							v-model="record.name"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="8">
						<v-select
							:items="[
								{ title: 'PDF', value: 'application/pdf' },
								{
									title: 'Word 97-2004',
									value: 'application/msword',
								},
								{
									title: 'Word 2005+',
									value: 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
								},
								{
									title: 'Excel 97-2004',
									value: 'application/vnd.ms-excel',
								},
								{
									title: 'Excel 2005+',
									value: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
								},
							]"
							label="Mime"
							v-model="record.mime"
							hide-details
						></v-select>
					</v-col>

					<v-col cols="4">
						<v-text-field
							label="Size (byte)"
							v-model="record.maxsize"
							hide-details
						></v-text-field>
					</v-col>
				</v-row>
			</v-card-text>
		</template>
	</form-edit>
</template>

<script>
export default {
	name: "procurement-document-edit",
};
</script>
