<input type="hidden" value="wna" id="wni_or_wna" />
<div class="col-md-8 col-xs-12">
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="chart-wrapper">
				<div class="chart-title">
					Jumlah Total Penunggalan
				</div>
				<div class="chart-stage">
					 <div class='col-md-6 warna-dc'>
						 <span>DC</span>
						 <h1 class='text-center' id='jumlah_dc'></h1>
					</div>
					<div class='col-md-6 warna-drc'>
						<span>DRC</span>
						<h1 class='text-center' id='jumlah_drc'></h1>
					</div>
				</div>
				<div class="chart-notes">
					&nbsp;<!--disini notes-->
				</div>
			</div>
		</div>
		<div class="col-md-12 col-xs-12">
			<div class="chart-wrapper">
				<div class="chart-title">
					Status Penunggalan <span class='warna-dc'>DC</span> &amp; <span class='warna-drc'>DRC</span>
				</div>
				<div class="chart-stage">
					<div id="status_dc_drc"></div>
				</div>
				<div class="chart-notes">
					&nbsp;<!--disini notes-->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-4 col-xs-12">
	<div class="chart-wrapper">
		<div class="chart-title">
			Selisih Penunggalan <span class='warna-dc'>DC</span> &amp; <span class='warna-drc'>DRC</span>
		</div>
		<div class="chart-stage" id="table-selisih">
		</div>
		<div class="chart-notes">
			&nbsp;
		</div>
	</div>
</div>

<div class="clearfix"></div>

<div class="col-md-12 dashboard-tab">
	
	<ul class="nav nav-tabs">
		<li class="active">
			<a  href="#stat_weekly" data-toggle="tab">Mingguan</a>
		</li>
		<li>
			<a href="#stat_monthly" data-toggle="tab">Bulanan</a>
		</li>
		<li>
			<a href="#stat_yearly" data-toggle="tab">Tahunan</a>
		</li>
	</ul>
	
	<div class="tab-content ">

		<div class="tab-pane active" id="stat_weekly">
			<div class='row'>
				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							ENROLL FAILURE AT REGIONAL
						</div>
						<div class="chart-stage">
							<div id="weekly_ENROLL_FAILURE_AT_REGIONAL"></div>
						</div>
						<div class="chart-notes">
							Weekly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							ADJUDICATE RECORD
						</div>
						<div class="chart-stage">
							<div id="weekly_ADJUDICATE_RECORD"></div>
						</div>
						<div class="chart-notes">
							Weekly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							DUPLICATE RECORD
						</div>
						<div class="chart-stage">
							<div id="weekly_DUPLICATE_RECORD"></div>
						</div>
						<div class="chart-notes">
							Weekly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							ENROLL FAILURE AT CENTRAL
						</div>
						<div class="chart-stage">
							<div id="weekly_ENROLL_FAILURE_AT_CENTRAL"></div>
						</div>
						<div class="chart-notes">
							Weekly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							PRINT READY RECORD
						</div>
						<div class="chart-stage">
							<div id="weekly_PRINT_READY_RECORD"></div>
						</div>
						<div class="chart-notes">
							Weekly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							SEARCH FAILURE AT CENTRAL
						</div>
						<div class="chart-stage">
							<div id="weekly_SEARCH_FAILURE_AT_CENTRAL"></div>
						</div>
						<div class="chart-notes">
							Weekly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="tab-pane" id="stat_monthly">
					
			<div class='row'>
				<div class="col-md-4 col-xs-6">
					<div class="chart-wrapper">
						<div class="chart-title">
							ENROLL FAILURE AT REGIONAL
						</div>
						<div class="chart-stage">
							<div id="monthly_ENROLL_FAILURE_AT_REGIONAL"></div>
						</div>
						<div class="chart-notes">
							Monthly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							ADJUDICATE RECORD
						</div>
						<div class="chart-stage">
							<div id="monthly_ADJUDICATE_RECORD"></div>
						</div>
						<div class="chart-notes">
							Monthly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							DUPLICATE RECORD
						</div>
						<div class="chart-stage">
							<div id="monthly_DUPLICATE_RECORD"></div>
						</div>
						<div class="chart-notes">
							Monthly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							ENROLL FAILURE AT CENTRAL
						</div>
						<div class="chart-stage">
							<div id="monthly_ENROLL_FAILURE_AT_CENTRAL"></div>
						</div>
						<div class="chart-notes">
							Monthly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							PRINT READY RECORD
						</div>
						<div class="chart-stage">
							<div id="monthly_PRINT_READY_RECORD"></div>
						</div>
						<div class="chart-notes">
							Monthly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							SEARCH FAILURE AT CENTRAL
						</div>
						<div class="chart-stage">
							<div id="monthly_SEARCH_FAILURE_AT_CENTRAL"></div>
						</div>
						<div class="chart-notes">
							Monthly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>
			</div>	
					
		</div>

		<div class="tab-pane" id="stat_yearly">

			<div class='row'>
				<div class="col-md-4 col-xs-6">
					<div class="chart-wrapper">
						<div class="chart-title">
							ENROLL FAILURE AT REGIONAL
						</div>
						<div class="chart-stage">
							<div id="yearly_ENROLL_FAILURE_AT_REGIONAL"></div>
						</div>
						<div class="chart-notes">
							Yearly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							ADJUDICATE RECORD
						</div>
						<div class="chart-stage">
							<div id="yearly_ADJUDICATE_RECORD"></div>
						</div>
						<div class="chart-notes">
							Yearly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							DUPLICATE RECORD
						</div>
						<div class="chart-stage">
							<div id="yearly_DUPLICATE_RECORD"></div>
						</div>
						<div class="chart-notes">
							Yearly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							ENROLL FAILURE AT CENTRAL
						</div>
						<div class="chart-stage">
							<div id="yearly_ENROLL_FAILURE_AT_CENTRAL"></div>
						</div>
						<div class="chart-notes">
							Yearly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							PRINT READY RECORD
						</div>
						<div class="chart-stage">
							<div id="yearly_PRINT_READY_RECORD"></div>
						</div>
						<div class="chart-notes">
							Yearly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-12">
					<div class="chart-wrapper">
						<div class="chart-title">
							SEARCH FAILURE AT CENTRAL
						</div>
						<div class="chart-stage">
							<div id="yearly_SEARCH_FAILURE_AT_CENTRAL"></div>
						</div>
						<div class="chart-notes">
							Yearly <span class='warna-dc'>DC</span>, <span class='warna-drc'>DRC</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>


<div class="col-md-12">	
	<div class='row'>
		<div class="col-md-6 col-xs-12">
			<div class="chart-wrapper">
				<div class="chart-title">
					Penunggalan Propinsi <span class='warna-dc'>DC</span> &amp; <span class='warna-drc'>DRC</span>
				</div>
				<div class="chart-stage">
					<div id="table_propinsi"></div>
				</div>
				<div class="chart-notes">
					
				</div>
			</div>
		</div>
		
		<div class="col-md-6 col-xs-12">
			<div class="chart-wrapper">
				<div class="chart-title">
					Penunggalan Kabupaten/Kota <span class='warna-dc'>DC</span> &amp; <span class='warna-drc'>DRC</span>
				</div>
				<div class="chart-stage">
					<div id="table_kabupaten"></div>
				</div>
				<div class="chart-notes">
					
				</div>
			</div>
		</div>
	</div>
</div>
