<template>
	<page-home page-name="procurement-dashboard">
		<template v-slot:default="{ record }">
			<v-row class="mt-4" dense>
				<v-col
					v-for="(widget, index) in record.widgets"
					:key="index"
					md="2"
					sm="3"
					xs="4"
				>
					<widget-statistic
						:icon="widget.icon"
						:title="widget.title"
						:complete="widget.complete"
						:count="widget.count"
						:year="widget.year"
						:color="widget.color"
					></widget-statistic>
				</v-col>
			</v-row>
		</template>
	</page-home>
</template>

<script>
export default {
	name: "procurement-dashboard",
};
</script>
