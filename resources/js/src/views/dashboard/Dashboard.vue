<template>
    <div class="layout-px-spacing dash_1">
        <portal to="breadcrumb">
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;">{{ $t('dashboard') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>{{ $t('view') }}</span></li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>
        </portal>

        <div class="row layout-top-spacing">
            <!-- <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-revenue">
                    <div class="widget-heading">
                        <h5>Revenue</h5>
                    </div>

                    <div class="widget-content">
                        <div class="chart-title">Total <span class="text-primary ml-1">{{ totalProfit }}</span></div>
                        <apexchart v-if="revenue_options && isDataLoaded" height="325" type="area" :options="revenue_options" :series="revenue_series"></apexchart>
                    </div>
                </div>
            </div> -->

            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-sales-category">
                    <div class="widget-heading">
                        <h5>User Counts</h5>
                    </div>
                    <div class="widget-content">
                        <apexchart v-if="sales_donut_options" height="460" type="donut" :options="sales_donut_options"
                            :series="sales_donut_series"></apexchart>
                    </div>
                </div>
            </div>


            <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-recent-activity">
                    <div class="widget-heading">
                        <h5>Recent Activities</h5>
                    </div>
                    <div class="widget-content">
                        <perfect-scrollbar class="timeline-line">
                            <div v-for="activity in activities" class="item-timeline timeline-success">
                                <div class="badge badge-success"></div>
                                <div class="t-text">
                                    <p>{{ activity.activity }} <a href="javascript:void(0);"> {{ activity.user_name }}</a>
                                    </p>
                                    <b-badge
                                        variant="outline-success outline-badge-success icon-fill-success">Completed</b-badge>
                                    <p class="t-time">{{ activity.created_date }}</p>
                                </div>
                            </div>
                        </perfect-scrollbar>
                    </div>
                </div>
            </div>

            <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-wallet-balance">
                    <div class="widget-heading d-block">
                        <div class="wallet-usr-info">
                            <div class="usr-name">
                                <span><img src="@/assets/images/dummy_profile.png" alt="admin-profile" class="img-fluid" />
                                    Alan Green</span>
                            </div>
                            <div class="add">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                            </div>
                        </div>
                        <div class="wallet-balance">
                            <p>Wallet Balance</p>
                            <h5><span class="w-currency">$</span>2953</h5>
                        </div>
                    </div>

                    <div class="widget-amount">
                        <div class="w-a-info funds-received mr-3">
                            <span>Received
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-up text-success float-right">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg></span>
                            <p>$97.99</p>
                        </div>
                        <div class="w-a-info funds-spent">
                            <span>Spent
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down text-danger float-right">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></span>
                            <p>$53.00</p>
                        </div>
                    </div>

                    <div class="widget-content">
                        <div class="bills-stats mb-4">
                            <span>Pending</span>
                        </div>
                        <div class="invoice-list">
                            <div class="inv-detail mb-4">
                                <div class="info-detail-1">
                                    <p>Netflix</p>
                                    <p><span class="w-currency">$</span> <span class="bill-amount">13.85</span></p>
                                </div>
                                <div class="info-detail-2">
                                    <p>BlueHost VPN</p>
                                    <p><span class="w-currency">$</span> <span class="bill-amount">15.66</span></p>
                                </div>
                            </div>
                            <div class="inv-action">
                                <b-button tag="a" variant="outline-secondary" class="view-details">View Details</b-button>
                                <b-button tag="a" variant="outline-success" class="pay-now">Pay Now $29.51</b-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-recent-orders">
                    <div class="widget-heading">
                        <h5>Recent Orders</h5>
                    </div>
                    <div class="widget-content">
                        <b-table-simple responsive>
                            <b-thead>
                                <b-tr>
                                    <b-th>
                                        <div class="th-content">Id</div>
                                    </b-th>
                                    <b-th>
                                        <div class="th-content">User</div>
                                    </b-th>
                                    <b-th>
                                        <div class="th-content">Amount</div>
                                    </b-th>
                                    <b-th>
                                        <div class="th-content th-heading">Date</div>
                                    </b-th>
                                </b-tr>
                            </b-thead>
                            <b-tbody>
                                <b-tr v-for="order in recent_orders" :key="order.id">
                                    <b-td>
                                        <div class="td-content text-primary">{{ order.id }}</div>
                                    </b-td>
                                    <b-td>
                                        <div class="td-content">
                                            <!-- <img v-if="order.customer_image"
                                                :src="'/storage/customers/' + order.customer_image" alt="avatar" /> -->
                                            <!-- <img src="@/assets/images/dummy_profile.png" alt="avatar" /> -->
                                            <!-- <span>{{ order.customer_name }}</span>
                                        </div>
                                    </b-td>
                                    <b-td>
                                        <div class="td-content text-primary">{{ order.amount }}</div>
                                    </b-td>
                                    <b-td>
                                        <div class="td-content">{{ order.created_date }}</div>
                                    </b-td>
                                </b-tr>

                            </b-tbody>
                        </b-table-simple>
                    </div>
                </div>
            </div> --> 

            
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import VueApexCharts from 'vue-apexcharts';
Vue.use(VueApexCharts);
Vue.component('apexchart', VueApexCharts);

import '@/assets/sass/widgets/widgets.scss';

export default {
    metaInfo: { title: 'Admin' },
    data() {
        return {
            activities: [],
            recentPayments: [],
            recentlyAddedCustomers: [],
            attendances: [],
            totalProfit: 0,
            isDataLoaded: false,
            adminCount: 0,
            studentCount: 0,
            parentCount: 0,
            latestAttendances: [],
            latestProgressReports: [],
            parentStudents: [],
            studentColors: ['#FFC0CB', '#ADD8E6', '#98FB98', '#FFD700', '#FFA07A'], // Add more colors as needed
            //user count down
            userCountsDonutSeries: [],
            userCountsDonutOptions: {},
            loggedInUserId: null, // Add a property to store the logged-in user ID
            loggedInUserRole: null,

            //Daily Sales
            daily_sales_series: [
                { name: 'Sales', data: [44, 55, 41, 67, 22, 43, 21] },
                { name: 'Last Week', data: [13, 23, 20, 8, 13, 27, 33] }
            ],

            //Total Orders
            total_orders_series: [{ name: 'Sales', data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40] }],

            //Revenue
            revenue_series: [
                { name: 'Income', data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0] },
            ],

            //Sales by Category
            sales_donut_series: [985, 737, 270]
        };
    },
    computed: {
        //Revenue
        revenue_options() {
            const is_dark = this.$store.state.is_dark_mode;
            return {
                chart: {
                    fontFamily: 'Nunito, sans-serif',
                    zoom: { enabled: true },
                    toolbar: { show: true },
                    events: {
                        mounted: function (ctx) {
                            const highest1 = ctx.getHighestValueInSeries(0);
                            const highest2 = ctx.getHighestValueInSeries(1);

                            ctx.addPointAnnotation({
                                x: 'Jul',
                                y: highest1,
                                label: { style: { cssClass: 'd-none' } },
                                customSVG: {
                                    SVG:
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                                    cssClass: undefined,
                                    offsetX: -8,
                                    offsetY: 7
                                }
                            });

                            ctx.addPointAnnotation({
                                x: 'Jun',
                                y: highest2,
                                label: { style: { cssClass: 'd-none' } },
                                customSVG: {
                                    SVG:
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                                    cssClass: undefined,
                                    offsetX: -8,
                                    offsetY: 7
                                }
                            });
                        }
                    }
                },
                dataLabels: { enabled: false },
                stroke: { show: true, curve: 'smooth', width: 2, lineCap: 'square' },
                dropShadow: { enabled: true, opacity: 0.2, blur: 10, left: -7, top: 22 },
                colors: is_dark ? ['#2196f3', '#e7515a'] : ['#1b55e2', '#e7515a'],
                markers: {
                    discrete: [
                        { seriesIndex: 0, dataPointIndex: 7, fillColor: '#000', strokeColor: '#000', size: 5 },
                        { seriesIndex: 2, dataPointIndex: 11, fillColor: '#000', strokeColor: '#000', size: 4 }
                    ]
                },
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                xaxis: {
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    crosshairs: { show: true },
                    labels: { offsetX: 0, offsetY: 5, style: { fontSize: '12px', fontFamily: 'Nunito, sans-serif', cssClass: 'apexcharts-xaxis-title' } }
                },
                yaxis: {
                    tickAmount: 7,
                    labels: {
                        formatter: function (value) {
                            if (value < 1000000) {
                                return value / 1000 + 'K';
                            } else {
                                return value / 1000000 + 'M'
                            }
                        },
                        offsetX: -10,
                        offsetY: 0,
                        style: { fontSize: '12px', fontFamily: 'Nunito, sans-serif', cssClass: 'apexcharts-yaxis-title' }
                    }
                },
                grid: {
                    borderColor: is_dark ? '#191e3a' : '#e0e6ed',
                    strokeDashArray: 5,
                    xaxis: { lines: { show: true } },
                    yaxis: { lines: { show: false } },
                    padding: { top: 0, right: 0, bottom: 0, left: 0 }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetY: 0,
                    fontSize: '16px',
                    fontFamily: 'Nunito, sans-serif',
                    markers: { width: 10, height: 10, strokeWidth: 0, strokeColor: '#fff', fillColors: undefined, radius: 12, onClick: undefined, offsetX: 0, offsetY: 0 },
                    itemMargin: { horizontal: 20, vertical: 5 }
                },
                tooltip: { theme: 'dark', marker: { show: true }, x: { show: false } },
                fill: {
                    type: 'gradient',
                    gradient: {
                        type: 'vertical',
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: is_dark ? 0.19 : 0.28,
                        opacityTo: 0.05,
                        stops: is_dark ? [100, 100] : [45, 100]
                    }
                }
            };
        },

        /*
        //Daily Sales
        daily_sales_options() {
            return {
                chart: { toolbar: { show: false }, stacked: true, stackType: '100%' },
                dataLabels: { enabled: false },
                stroke: { show: true, width: 1 },
                colors: ['#e2a03f', '#e0e6ed'],
                responsive: [{ breakpoint: 480, options: { legend: { position: 'bottom', offsetX: -10, offsetY: 0 } } }],
                xaxis: { labels: { show: false }, categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'] },
                yaxis: { show: false },
                fill: { opacity: 1 },
                plotOptions: { bar: { horizontal: false, columnWidth: '25%' } },
                legend: { show: false },
                grid: {
                    show: false,
                    xaxis: { lines: { show: false } },
                    padding: { top: 10, right: -20, bottom: -20, left: -20 }
                }
            };
        },

        //Total Orders
        total_orders_options() {
            const is_dark = this.$store.state.is_dark_mode;
            return {
                chart: { sparkline: { enabled: true } },
                stroke: { curve: 'smooth', width: 2 },
                colors: is_dark ? ['#1abc9c'] : ['#fff'],
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                yaxis: { min: 0, show: false },
                grid: { padding: { top: 125, right: 0, bottom: 0, left: 0 } },
                fill: {
                    opacity: 1,
                    type: 'gradient',
                    gradient: {
                        type: 'vertical',
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: is_dark ? 0.3 : 0.4,
                        opacityTo: 0.05,
                        stops: is_dark ? [100, 100] : [45, 100]
                    }
                },
                tooltip: { x: { show: false }, theme: 'dark' }
            };
        }, */

        //Sales by Category
        sales_donut_options() {
            const is_dark = this.$store.state.is_dark_mode;
            let option = {
                chart: {},
                dataLabels: { enabled: false },
                expandOnClick: is_dark ? false : true,
                stroke: { show: true, width: 25, colors: is_dark ? '#0e1726' : '#fff' },
                colors: is_dark ? ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'] : ['#e2a03f', '#5c1ac3', '#e7515a'],
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    fontSize: '14px',
                    markers: { width: 10, height: 10 },
                    height: 50,
                    offsetY: 20,
                    itemMargin: { horizontal: 8, vertical: 0 }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            background: 'transparent',
                            labels: {
                                show: true,
                                name: { show: true, fontSize: '29px', fontFamily: 'Nunito, sans-serif', offsetY: -10 },
                                value: {
                                    show: true,
                                    fontSize: '26px',
                                    fontFamily: 'Nunito, sans-serif',
                                    color: is_dark ? '#bfc9d4' : undefined,
                                    offsetY: 16,
                                    formatter: function (val) {
                                        return val;
                                    }
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    color: '#888ea8',
                                    fontSize: '29px',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce(function (a, b) {
                                            return a + b;
                                        }, 0);
                                    }
                                }
                            }
                        }
                    }
                },
                labels: ['Apparel', 'Sports', 'Others']
            };

            if (is_dark) {
                option['states'] = {
                    hover: { filter: { type: 'none' } },
                    active: { filter: { type: 'none' } }
                };
            }

            return option;
        },

        isAdminOrSuperAdmin() {
            // Check if the logged-in user is an admin or super admin
            return this.loggedInUserRole === 'Super Admin' || this.loggedInUserRole === 'Admin';
        },
        isStudent() {
            // Check if the logged-in user is a student
            return this.loggedInUserRole === 'Student';
        },
        // Filter the latestAttendances for the logged-in student
        studentAttendances() {
            return this.latestAttendances.filter(attendance => attendance.user.id === this.loggedInUserId);
        },
    },


    mounted() {
        this.fetchActivites()
        this.fetchPayments()
        this.fetchCustomers()
        this.fetchAttendances()
        this.fetchUserCounts();
        this.fetchLatestAttendances();
        this.fetchLatestProgressReports();
        this.fetchUser();
        this.fetchParentStudents();

    },
    created() {
        this.fetchUserCounts();
    },


    methods: {
        async fetchUser() {
            try {
                const response = await axios.get('/admin/user/progress');
                if (response.data) {
                    this.loggedInUserId = response.data.id;
                    this.loggedInUserRole = response.data.type;
                    // Fetch parent's students for the dashboard
                    if (this.loggedInUserRole === 'Parent') {
                        this.fetchParentStudents();
                    }
                    this.fetchUserCounts();
                    this.fetchLatestAttendances();
                    this.fetchLatestProgressReports();
                    this.fetchActivites()
                }
            } catch (error) {
                console.error('Error fetching user details:', error);
            }
        },
        async fetchParentStudents() {
            try {
                const response = await axios.get('/admin/dashboard/parent-students');
                this.parentStudents = response.data; // Assuming you have a property like parentStudents in your data
            } catch (error) {
                console.error('Error fetching parent students:', error);
            }
        },
        fetchLatestProgressReports() {
            axios
                .get("/admin/fetch/latest-progress-reports")
                .then((res) => {
                    if (res.status === 200) {
                        this.latestProgressReports = res.data;
                    }
                })
                .catch((err) => {
                    console.log("Error fetching latest progress reports:", err);
                });
        },
        fetchLatestAttendances() {
            axios
                .get("/admin/fetch/latest-attendances")
                .then((res) => {
                    if (res.status === 200) {
                        this.latestAttendances = res.data;
                    }
                })
                .catch((err) => {
                    console.error("Error fetching latest attendance:", err);
                });
        },
        async fetchUserCounts() {
            try {
                const response = await axios.get('/admin/fetch/user-counts');
                const { adminCount, studentCount, parentCount } = response.data;

                this.userCountsDonutSeries = [adminCount, studentCount, parentCount];
                this.userCountsDonutOptions = this.getUserCountsDonutOptions(adminCount + studentCount + parentCount);
            } catch (error) {
                console.error('Error fetching user counts:', error);
            }
        },
        getUserCountsDonutOptions(totalUsers) {
            const is_dark = this.$store.state.is_dark_mode;
            return {
                chart: {},
                labels: ["Admin", "Student", "Parent"],
                plotOptions: {
                    pie: {
                        donut: {
                            size: "65%",
                            background: "transparent",
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: "29px",
                                    fontFamily: "Nunito, sans-serif",
                                    offsetY: -10,
                                },
                                value: {
                                    show: true,
                                    fontSize: "26px",
                                    fontFamily: "Nunito, sans-serif",
                                    color: is_dark ? "#bfc9d4" : undefined,
                                    offsetY: 16,
                                    formatter: function (val) {
                                        return val;
                                    },
                                },
                                total: {
                                    show: true,
                                    label: "Total",
                                    color: "#888ea8",
                                    fontSize: "29px",
                                    formatter: function () {
                                        return totalUsers;
                                    },
                                },
                            },
                        },
                    },
                },
            };
        },
        //Fetch all activities details from db
        fetchActivites() {
            axios
                .get("/admin/fetch/activities")
                .then((res) => {
                    if (res.status == 200) {
                        this.activities = res.data;

                    }
                }).catch((err) => {
                    console.log("error:" + err);
                });
        },


        //Fetch all payment details from db
        fetchPayments() {
            axios
                .get("/admin/fetch/payments-with-customer")
                .then((res) => {
                    if (res.status == 200) {
                        if (res.data.length > 6) {
                            for (let i = res.data.length - 6; i < res.data.length; i++) {
                                this.recentPayments.unshift(res.data[i])
                            }
                        } else {
                            for (let i = 0; i < res.data.length; i++) {
                                this.recentPayments.unshift(res.data[i])
                            }
                        }
                    }
                    let monthlyRevenue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]

                    for (let i = 0; i < res.data.length; i++) {
                        this.totalProfit += parseFloat(res.data[i].amount)

                        const createdDate = new Date(res.data[i].created_date)
                        const monthIndex = createdDate.getMonth()

                        monthlyRevenue[monthIndex] += parseFloat(res.data[i].amount)
                    }

                    this.revenue_series[0].data = monthlyRevenue
                    this.isDataLoaded = true

                    const lankanCurrencyFormatter = new Intl.NumberFormat("en-US", { style: "currency", currency: "LKR" });
                    this.totalProfit = lankanCurrencyFormatter.format(this.totalProfit)


                }).catch((err) => {
                    console.log("error:" + err);
                });

        },

        //Fetch all the customers from the database
        fetchCustomers() {
            axios
                .get("/admin/fetch/customer")
                .then((res) => {

                    if (res.data.length > 6) {
                        for (let i = res.data.length - 6; i < res.data.length; i++) {
                            this.recentlyAddedCustomers.unshift(res.data[i])
                        }
                    } else {
                        for (let i = 0; i < res.data.length; i++) {
                            this.recentlyAddedCustomers.unshift(res.data[i])
                        }
                    }
                })
                .catch((err) => {
                    console.log("error:" + err);
                });
        },

        //Fetch all attendances with customers from the database
        fetchAttendances() {
            axios
                .get("/admin/fetch/attendances-with-customer")
                .then((res) => {
                    if (res.data.length > 6) {
                        for (let i = res.data.length - 6; i < res.data.length; i++) {
                            this.attendances.push(res.data[i])
                        }
                    } else {
                        for (let i = 0; i < res.data.length; i++) {
                            this.attendances.push(res.data[i])
                        }
                    }
                })
                .catch((err) => {
                    console.log("error:" + err);
                });
        },

    },
};
</script>

<style scoped>
  /* Add styles for the new widget */
  .widget-parent-students {
    background-color: #fff;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .widget-parent-students .widget-heading h5 {
    color: #333;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .widget-parent-students .widget-content .student-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .widget-parent-students .widget-content .student-list li {
    margin-bottom: 15px;
  }

  .widget-parent-students .widget-content .student-list .student-name {
    font-size: 16px;
    font-weight: 500;
    margin-right: 10px;
  }

  .widget-parent-students .widget-content .student-list .enrolment-number {
    font-size: 14px;
    color: #777;
  }

  .widget-recent-activity .widget-content .student-list li {
    margin-bottom: 15px;
    margin-right: 30px;
    padding: 10px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
}

.widget-recent-activity .widget-content .student-list .dot-icon {
    width: 10px;
    height: 10px;
    background-color: #000; /* Adjust the color as needed */
    border-radius: 50%;
    margin-right: 10px;
  }

  .widget-recent-activity .widget-content .student-list .student-name {
    flex-grow: 1;
  }

.widget-recent-activity .widget-content .student-list .enrolment-number {
    font-weight: bold;
  }
</style>