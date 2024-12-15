<template>
	<form-show with-helpdesk>
		<template v-slot:default="{ combos: { workunits }, record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field
							label="Nama Paket"
							v-model="record.name"
							hide-details
							readonly
						></v-text-field>
					</v-col>

					<v-col cols="6">
						<v-select
							:items="['CONSTRUCTION', 'NONE-CONSTRUCTION']"
							label="Tipe"
							v-model="record.type"
							hide-details
							readonly
						></v-select>
					</v-col>

					<v-col cols="6">
						<v-select
							:items="[
								'DIKECUALIKAN',
								'E-PURCHASING',
								'TENDER',
								'TENDER-CEPAT',
								'PENGADAAN-LANGSUNG',
								'PENUNJUKAN-LANGSUNG',
							]"
							label="Metode"
							v-model="record.method"
							hide-details
							readonly
						></v-select>
					</v-col>

					<v-col cols="6">
						<v-select
							:items="[
								{ title: 'JANUARY', value: 1 },
								{ title: 'FEBRUARI', value: 2 },
								{ title: 'MARET', value: 3 },
								{ title: 'APRIL', value: 4 },
								{ title: 'MEI', value: 5 },
								{ title: 'JUNI', value: 6 },
								{ title: 'JULI', value: 7 },
								{ title: 'AGUSTUS', value: 8 },
								{ title: 'SEPTEMBER', value: 9 },
								{ title: 'OKTOBER', value: 10 },
								{ title: 'NOVEMBER', value: 11 },
								{ title: 'DESEMBER', value: 12 },
							]"
							label="Metode"
							v-model="record.month"
							hide-details
							readonly
						></v-select>
					</v-col>

					<v-col cols="6">
						<v-text-field
							label="Tahun"
							v-model="record.year"
							hide-details
							readonly
						></v-text-field>
					</v-col>

					<v-col cols="6">
						<v-select
							:items="[
								'APBN',
								'APBNP',
								'APBD',
								'APBDP',
								'PHLN',
								'PNBP',
								'BUMN',
								'BUMD',
							]"
							label="Sumber Dana"
							v-model="record.source"
							hide-details
							readonly
						></v-select>
					</v-col>

					<v-col cols="6">
						<v-text-field
							label="Pagu"
							v-model="record.ceiling"
							hide-details
							readonly
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-combobox
							:items="workunits"
							label="Unit Kerja"
							v-model="record.workunit_id"
							hide-details
							readonly
						></v-combobox>
					</v-col>
				</v-row>
			</v-card-text>
		</template>

		<template v-slot:helpdesk></template>
	</form-show>
</template>

<script>
export default {
	name: "procurement-history-show",
};
</script>
