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

					<v-col cols="5">
						<v-text-field
							label="NIP"
							v-model="record.slug"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="7">
						<v-select
							:items="[
								'PENGATUR MUDA (II/A)',
								'PENGATUR MUDA TINGKAT  I (II/B)',
								'PENGATUR (II/C)',
								'PENGATUR TINGKAT  I (II/D)',
								'PENATA MUDA (III/A)',
								'PENATA MUDA TINGKAT  I (III/B)',
								'PENATA (III/C)',
								'PENATA TINGKAT  I (III/D)',
								'PEMBINA (IV/A)',
								'PEMBINA TINGKAT  I (IV/B)',
								'PEMBINA UTAMA MUDA (IV/C)',
								'PEMBINA UTAMA MADYA (IV/D)',
								'PEMBINA UTAMA (IV/E)',
							]"
							label="Pangkat"
							v-model="record.section"
							hide-details
						></v-select>
					</v-col>

					<v-col cols="12">
						<v-text-field
							label="Jabatan"
							v-model="record.position"
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
	name: "procurement-member-edit",
};
</script>
