from django.contrib import admin

# Register your models here.
from firstResponderDashboard.models import textInstance, CallInstance, incomingEvent

admin.site.register(textInstance)
admin.site.register(CallInstance)
admin.site.register(incomingEvent)