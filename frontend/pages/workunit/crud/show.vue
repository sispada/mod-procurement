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
				</v-row>
			</v-card-text>
		</template>

		<template v-slot:info="{ theme }">
			<div class="text-overline mt-4">Aksi</div>
			<v-divider></v-divider>

			<v-btn
				class="mt-3"
				:color="theme"
				block
				variant="flat"
				@click="$router.push({ name: 'procurement-officer' })"
				>DAFTAR PPK</v-btn
			>
		</template>
	</form-show>
</template>

<script>
export default {
	name: "procurement-workunit-show",
};
</script>
