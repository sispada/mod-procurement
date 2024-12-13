<template>
	<form-create with-helpdesk>
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

					<v-col cols="12">
						<v-text-field
							label="Pangkat / Golongan Ruang"
							v-model="record.section"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-text-field
							label="Jabatan"
							v-model="record.position"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-text-field
							label="Unit Kerja"
							v-model="record.workunit_id"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-select
							:items="['KABAG', 'KASUBAG', 'ADMINISTRATOR']"
							label="Role"
							v-model="record.role"
							hide-details
						></v-select>
					</v-col>
				</v-row>
			</v-card-text>
		</template>
	</form-create>
</template>

<script>
export default {
	name: "procurement-biodata-create",
};
</script>
