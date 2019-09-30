<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th class="text-center"></th>
                <th class="text-center" :colspan="elevatorsCount">Лифты</th>
            </tr>
            <tr>
                <th class="text-center">Этажи</th>
                <th v-for="elevator in elevatorsCount" class="text-center">{{ elevator }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="floor in floorsRange">
                <td class="text-center">
                    <button type="button"
                            class="btn btn-sm"
                            :class="{'btn-primary': stateOrderOnFloor(floor), 'btn-secondary': !stateOrderOnFloor(floor)}"
                            @click="makeOrder(floor)">
                        {{ floor }}
                    </button>
                </td>
                <td v-for="elevator in elevatorsCount" class="text-center">
                    <span class="badge"
                          :class="{'badge-primary': stateElevatorOnFloor(floor, elevator)}">&nbsp;&nbsp;</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        props: ['floorsCount', 'elevatorsCount', 'elevatorsSpeed'],
        data() {
            return {
                elevators: [],
                orders: [],
            }
        },
        computed: {
            floorsRange() {
                return _.range(this.floorsCount, 0)
            }
        },
        methods: {
            loadElevatorsState() {
                axios.get('/api/elevators/state')
                    .then(({data}) => {
                        this.elevators = data.elevators
                        this.orders = data.orders
                    })
                setTimeout(() => {
                    this.loadElevatorsState()
                }, this.elevatorsSpeed * 500);
            },
            elevatorFloor(elevatorId) {
                const elevator = this.elevators.find(elevator => {
                    return elevator.id == elevatorId
                })

                if (!elevator) {
                    return 0
                }

                return elevator.floor
            },
            stateElevatorOnFloor(floor, elevatorId) {
                return this.elevatorFloor(elevatorId) == floor
            },
            stateOrderOnFloor(floor) {
                return !!this.orders.find(order => {
                    return order.floor == floor
                })
            },
            makeOrder(floor) {
                axios.post('/api/orders', {floor})
                    .then(() => {
                        this.loadElevatorsState()
                    })
            }
        },
        created() {
            this.loadElevatorsState()
        }
    }
</script>
