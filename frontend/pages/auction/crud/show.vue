<template>
	<form-show with-helpdesk>
		<template
			v-slot:default="{ combos: { officers, methods, types, workunits }, record }"
		>
			<div class="position-absolute" style="top: 0; right: 0">
				<v-chip class="mt-3 mr-4" color="blue" size="small">{{
					record.status
				}}</v-chip>
			</div>

			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-textarea
							label="Nama Paket"
							rows="2"
							v-model="record.name"
							hide-details
							readonly
						></v-textarea>
					</v-col>

					<v-col cols="12">
						<v-currency-field
							label="Pagu"
							v-model="record.ceiling"
							hide-details
							readonly
						></v-currency-field>
					</v-col>

					<v-col cols="6">
						<v-select
							:items="types"
							label="Tipe"
							v-model="record.type_id"
							hide-details
							readonly
						></v-select>
					</v-col>

					<v-col cols="6">
						<v-select
							:items="methods"
							label="Metode"
							v-model="record.method_id"
							hide-details
							readonly
						></v-select>
					</v-col>

					<v-col cols="4">
						<v-select
							:items="[
								{
									title: 'JANUARY',
									value: 1,
								},
								{
									title: 'FEBRUARI',
									value: 2,
								},
								{
									title: 'MARET',
									value: 3,
								},
								{
									title: 'APRIL',
									value: 4,
								},
								{ title: 'MEI', value: 5 },
								{ title: 'JUNI', value: 6 },
								{ title: 'JULI', value: 7 },
								{
									title: 'AGUSTUS',
									value: 8,
								},
								{
									title: 'SEPTEMBER',
									value: 9,
								},
								{
									title: 'OKTOBER',
									value: 10,
								},
								{
									title: 'NOVEMBER',
									value: 11,
								},
								{
									title: 'DESEMBER',
									value: 12,
								},
							]"
							label="Metode"
							v-model="record.month"
							hide-details
							readonly
						></v-select>
					</v-col>

					<v-col cols="2">
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

					<v-col cols="12" v-if="record.mode === 'PPBJ'">
						<v-combobox
							:items="officers"
							:return-object="false"
							label="PPBJ"
							v-model="record.officer_id"
							hide-details
						></v-combobox>
					</v-col>

					<v-col cols="12">
						<v-combobox
							:items="workunits"
							label="Unit Kerja"
							v-model="record.workunit"
							hide-details
							readonly
						></v-combobox>
					</v-col>
				</v-row>
			</v-card-text>
		</template>

		<template
			v-slot:info="{
				combos: { workgroups },
				record,
				statuses: { isKASUBAG, isKABAG, isPOKJA },
				theme,
			}"
		>
			<div class="text-overline mt-4">Aksi</div>
			<v-divider></v-divider>
			<v-row dense>
				<!-- KASUBAG -->
				<v-col cols="6" v-if="record.status === 'SUBMITTED' && isKASUBAG">
					<v-btn
						class="mt-3"
						:color="theme"
						block
						@click="qualifiedAuction(record)"
						>LENGKAP</v-btn
					>
				</v-col>

				<v-col cols="6" v-if="record.status === 'SUBMITTED' && isKASUBAG">
					<v-btn
						class="mt-3"
						color="deep-orange"
						block
						@click="rejectedAuction(record)"
						>TOLAK</v-btn
					>
				</v-col>

				<!-- KABAG -->
				<v-col cols="12" v-if="record.status === 'QUALIFIED' && isKABAG">
					<v-select
						:items="workgroups"
						label="Pokja"
						v-model="record.workgroup_id"
						hide-details
					></v-select>
				</v-col>

				<v-col cols="6" v-if="record.status === 'QUALIFIED' && isKABAG">
					<v-btn
						class="mt-3"
						:color="theme"
						block
						@click="verifiedAuction(record)"
						>VERIFIKASI</v-btn
					>
				</v-col>

				<v-col cols="6" v-if="record.status === 'QUALIFIED' && isKABAG">
					<v-btn
						class="mt-3"
						color="deep-orange"
						block
						@click="abortedAuction(record)"
						>BATALKAN</v-btn
					>
				</v-col>

				<!-- POKJA -->
				<v-col cols="12" v-if="record.status === 'VERIFIED' && isPOKJA">
					<v-btn
						class="mt-3"
						:color="theme"
						block
						@click="evaluatedAuction(record)"
						>KIRIM EVALUASI</v-btn
					>
				</v-col>
			</v-row>
		</template>
	</form-show>
</template>

<script>
export default {
	name: "procurement-auction-show",

	methods: {
		submitAuction: function (record) {
			this.$http(`procurement/api/auction/${record.id}/submitted`, {
				method: "POST",
				params: { ...record, _method: "PUT" },
			}).then(() => {
				this.$router.push({
					name: "procurement-auction",
				});
			});
		},
		qualifiedAuction: function (record) {
			this.$http(`procurement/api/auction/${record.id}/qualified`, {
				method: "POST",
				params: { ...record, _method: "PUT" },
			}).then(() => {
				this.$router.push({
					name: "procurement-auction",
				});
			});
		},
		rejectedAuction: function (record) {
			this.$http(`procurement/api/auction/${record.id}/rejected`, {
				method: "POST",
				params: { ...record, _method: "PUT" },
			}).then(() => {
				this.$router.push({
					name: "procurement-auction",
				});
			});
		},
		verifiedAuction: function (record) {
			this.$http(`procurement/api/auction/${record.id}/verified`, {
				method: "POST",
				params: { ...record, _method: "PUT" },
			}).then(() => {
				this.$router.push({
					name: "procurement-auction",
				});
			});
		},
		abortedAuction: function (record) {
			this.$http(`procurement/api/auction/${record.id}/aborted`, {
				method: "PUT",
				params: { ...record, _method: "PUT" },
			}).then(() => {
				this.$router.push({
					name: "procurement-auction",
				});
			});
		},
		evaluatedAuction: function (record) {
			this.$http(`procurement/api/auction/${record.id}/avaluated`, {
				method: "PUT",
				params: { ...record, _method: "PUT" },
			}).then(() => {
				this.$router.push({
					name: "procurement-auction",
				});
			});
		},
	},
};
</script>
