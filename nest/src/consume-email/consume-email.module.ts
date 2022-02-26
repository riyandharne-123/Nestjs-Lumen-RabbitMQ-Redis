/* eslint-disable prettier/prettier */
import { Module } from '@nestjs/common';
import { RabbitMQModule } from '@golevelup/nestjs-rabbitmq';
import { ConsumeEmailController } from './consume-email.controller';
import { ConsumeEmailService } from './consume-email.service';

@Module({
  imports: [
    RabbitMQModule.forRoot(RabbitMQModule, {
        exchanges: [
          {
            name: 'amq.direct',
            type: 'direct',
          },
        ],
        uri: 'amqp://guest:guest@localhost:5672',
      }),
  ],
  controllers: [ConsumeEmailController],
  providers: [ConsumeEmailService],
})

export class ConsumeEmailModule {}
